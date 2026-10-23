<script setup lang="ts">
import { nextTick, onMounted, ref, watch } from 'vue'
import { useLocalizedValue } from '../composables/useLocalizedValue'
import type { TextFieldSchema } from '../types'

const props = defineProps<{
    field: TextFieldSchema
    modelValue: unknown
    variant?: 'default' | 'title' | 'lead'
    autofocus?: boolean
}>()

const emit = defineEmits<{ 'update:modelValue': [value: unknown] }>()

const { value, isMissingTranslation } = useLocalizedValue<string>(props, emit)

const textarea = ref<HTMLTextAreaElement | null>(null)
const input = ref<HTMLInputElement | null>(null)

function resize(): void {
    if (textarea.value) {
        textarea.value.style.height = 'auto'
        textarea.value.style.height = `${textarea.value.scrollHeight}px`
    }
}

function update(event: Event): void {
    const text = (event.target as HTMLInputElement | HTMLTextAreaElement).value

    value.value = text === '' ? null : text
}

onMounted(() => {
    resize()

    if (props.autofocus) {
        ;(textarea.value ?? input.value)?.focus()
    }
})
watch(value, () => nextTick(resize))
</script>

<template>
    <textarea
        v-if="field.multiline || variant === 'title'"
        ref="textarea"
        class="text-input"
        :class="[`is-${variant ?? 'default'}`, { missing: isMissingTranslation }]"
        rows="1"
        :value="value ?? ''"
        :maxlength="field.maxLength"
        :placeholder="isMissingTranslation ? 'Pas encore traduit' : field.label"
        @input="update"
    />
    <input
        v-else
        ref="input"
        type="text"
        class="text-input"
        :class="[`is-${variant ?? 'default'}`, { missing: isMissingTranslation }]"
        :value="value ?? ''"
        :maxlength="field.maxLength"
        :placeholder="isMissingTranslation ? 'Pas encore traduit' : field.label"
        @input="update"
    />
</template>
