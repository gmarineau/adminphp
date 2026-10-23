<script setup lang="ts">
import { computed } from 'vue'
import { useEditorStore } from '../stores/editor'
import type { FieldSchema } from '../types'
import BlocksField from './BlocksField.vue'
import FieldInput from './FieldInput.vue'

const props = withDefaults(
    defineProps<{
        field: FieldSchema
        modelValue: unknown
        path: string
        layout?: 'row' | 'stacked'
        variant?: 'default' | 'title' | 'lead'
        autofocus?: boolean
    }>(),
    { layout: 'row', variant: 'default', autofocus: false },
)

const emit = defineEmits<{ 'update:modelValue': [value: unknown] }>()

const editor = useEditorStore()

const error = computed(() => {
    const ownError = editor.errorFor(props.path)

    return ownError ?? (props.field.translatable ? editor.errorFor(`${props.path}.${editor.locale}`) : null)
})
</script>

<template>
    <BlocksField
        v-if="field.type === 'blocks'"
        :field="field"
        :model-value="modelValue"
        :path="path"
        @update:model-value="emit('update:modelValue', $event)"
    />

    <section v-else-if="layout === 'row'" class="block" :class="{ 'has-error': error }">
        <div class="gutter">
            <span class="type">{{ field.label }}<i v-if="field.required" class="required" title="Obligatoire">*</i></span>
            <span v-if="field.translatable" class="locale-tag">{{ editor.locale }}</span>
        </div>
        <div class="body">
            <FieldInput :field="field" :model-value="modelValue" :variant="variant" :autofocus="autofocus" @update:model-value="emit('update:modelValue', $event)" />
            <p v-if="error" class="field-error">{{ error }}</p>
        </div>
    </section>

    <div v-else class="stacked-field" :class="{ 'has-error': error }">
        <span class="stacked-label">{{ field.label }}<i v-if="field.required" class="required">*</i></span>
        <FieldInput :field="field" :model-value="modelValue" :variant="variant" :autofocus="autofocus" @update:model-value="emit('update:modelValue', $event)" />
        <p v-if="error" class="field-error">{{ error }}</p>
    </div>
</template>
