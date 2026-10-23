<script setup lang="ts">
import { computed, nextTick, onMounted, ref, watch } from 'vue'
import { useRouter } from 'vue-router'
import { api, ApiError } from '../api'
import { isFilled } from '../composables/useLocalizedValue'
import { config } from '../config'
import FieldRenderer from '../fields/FieldRenderer.vue'
import { useEditorStore } from '../stores/editor'
import { useModulesStore } from '../stores/modules'
import type { BlockValue, FieldSchema, FormValues, ModuleSchema } from '../types'

const props = defineProps<{ module: string; id?: string }>()

const router = useRouter()
const modulesStore = useModulesStore()
const editor = useEditorStore()

const schema = ref<ModuleSchema | null>(null)
const values = ref<FormValues>({})
const itemTitle = ref('')
const isDirty = ref(false)
const isSaving = ref(false)
const toast = ref<string | null>(null)

function emptyValue(field: FieldSchema): unknown {
    if (field.type === 'blocks') {
        return []
    }

    return field.translatable ? {} : null
}

/**
 * Whether a translatable value is filled in the default locale but not in the given one,
 * looking inside blocks too.
 */
function hasMissingTranslation(fields: FieldSchema[], fieldValues: Record<string, unknown>, locale: string): boolean {
    return fields.some((field) => {
        const value = fieldValues[field.name]

        if (field.type === 'blocks') {
            return ((value as BlockValue[] | undefined) ?? []).some((block) => {
                const blockSchema = field.blocks.find((candidate) => candidate.type === block.type)

                return blockSchema !== undefined && hasMissingTranslation(blockSchema.fields, block.content, locale)
            })
        }

        if (!field.translatable) {
            return false
        }

        const translations = (value ?? {}) as Record<string, unknown>

        return isFilled(translations[config.defaultLocale]) && !isFilled(translations[locale])
    })
}

const localesWithGaps = computed(() =>
    schema.value === null
        ? []
        : config.locales.filter((locale) => locale !== config.defaultLocale && hasMissingTranslation(schema.value!.fields, values.value, locale)),
)

function showToast(message: string): void {
    toast.value = message
    setTimeout(() => (toast.value = null), 2000)
}

async function save(): Promise<void> {
    isSaving.value = true
    editor.errors = {}

    try {
        const item = props.id
            ? await api.updateItem(props.module, props.id, values.value)
            : await api.createItem(props.module, values.value)

        values.value = item.values
        itemTitle.value = item.title
        await nextTick()
        isDirty.value = false
        showToast('Enregistré')
        modulesStore.loadModules()

        if (!props.id) {
            await router.replace({ name: 'module.edit', params: { module: props.module, id: item.id } })
        }
    } catch (error) {
        if (error instanceof ApiError && error.status === 422) {
            editor.errors = error.errors
            showToast('Certains champs sont à corriger')
        } else {
            showToast('L’enregistrement a échoué')
            throw error
        }
    } finally {
        isSaving.value = false
    }
}

onMounted(async () => {
    editor.locale = config.defaultLocale
    editor.errors = {}

    schema.value = await modulesStore.schema(props.module)

    if (props.id) {
        const item = await api.item(props.module, props.id)
        values.value = item.values
        itemTitle.value = item.title
    } else {
        values.value = Object.fromEntries(schema.value.fields.map((field) => [field.name, emptyValue(field)]))
        itemTitle.value = 'Nouveau'
    }

    watch(values, () => (isDirty.value = true), { deep: true })
})
</script>

<template>
    <main class="page editor">
        <header class="top">
            <div class="crumbs">
                <RouterLink :to="{ name: 'module.index', params: { module } }">{{ schema?.title }}</RouterLink>
                /
                <strong>{{ itemTitle }}</strong>
            </div>

            <div v-if="config.locales.length > 1" class="langs" role="group" aria-label="Langue de saisie">
                <button
                    v-for="locale in config.locales"
                    :key="locale"
                    type="button"
                    :aria-pressed="editor.locale === locale"
                    @click="editor.locale = locale"
                >
                    {{ locale.toUpperCase() }}
                    <i v-if="localesWithGaps.includes(locale)" class="gap" title="Traduction incomplète" />
                </button>
            </div>

            <span class="status" :class="{ saved: !isDirty }">{{ isDirty ? 'Modifications non enregistrées' : 'Enregistré' }}</span>
            <button type="button" class="btn primary" :disabled="isSaving" @click="save">{{ isSaving ? 'Enregistrement…' : 'Enregistrer' }}</button>
        </header>

        <div v-if="schema" class="canvas">
            <div class="doc">
                <FieldRenderer
                    v-for="(field, index) in schema.fields"
                    :key="field.name"
                    v-model="values[field.name]"
                    :field="field"
                    :path="field.name"
                    :variant="index === 0 && field.type === 'text' ? 'title' : index === 1 && field.type === 'text' ? 'lead' : 'default'"
                />
            </div>
        </div>

        <div class="toast" :class="{ on: toast }" role="status">{{ toast }}</div>
    </main>
</template>
