<script setup lang="ts">
import type { FieldSchema } from '../types'
import RichTextField from './RichTextField.vue'
import TextField from './TextField.vue'

defineProps<{
    field: FieldSchema
    modelValue: unknown
    variant?: 'default' | 'title' | 'lead'
    autofocus?: boolean
}>()

const emit = defineEmits<{ 'update:modelValue': [value: unknown] }>()
</script>

<template>
    <TextField
        v-if="field.type === 'text'"
        :field="field"
        :model-value="modelValue"
        :variant="variant"
        :autofocus="autofocus"
        @update:model-value="emit('update:modelValue', $event)"
    />
    <RichTextField
        v-else-if="field.type === 'rich-text'"
        :field="field"
        :model-value="modelValue"
        :autofocus="autofocus"
        @update:model-value="emit('update:modelValue', $event)"
    />
</template>
