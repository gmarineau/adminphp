import { computed, type ComputedRef, type WritableComputedRef } from 'vue'
import { config } from '../config'
import { useEditorStore } from '../stores/editor'
import type { BaseFieldSchema } from '../types'

/**
 * Exposes the value of a field in the current editing locale. Translatable values
 * are objects keyed by locale; other values are edited as is.
 */
export function useLocalizedValue<T>(
    props: { field: BaseFieldSchema; modelValue: unknown },
    emit: (event: 'update:modelValue', value: unknown) => void,
): { value: WritableComputedRef<T | null>; isMissingTranslation: ComputedRef<boolean> } {
    const editor = useEditorStore()

    const value = computed<T | null>({
        get() {
            if (!props.field.translatable) {
                return (props.modelValue as T | null) ?? null
            }

            const translations = (props.modelValue ?? {}) as Record<string, T | null>

            return translations[editor.locale] ?? null
        },
        set(newValue) {
            if (!props.field.translatable) {
                emit('update:modelValue', newValue)

                return
            }

            emit('update:modelValue', { ...((props.modelValue ?? {}) as object), [editor.locale]: newValue })
        },
    })

    const isMissingTranslation = computed(() => {
        if (!props.field.translatable || editor.locale === config.defaultLocale) {
            return false
        }

        const translations = (props.modelValue ?? {}) as Record<string, unknown>

        return isFilled(translations[config.defaultLocale]) && !isFilled(translations[editor.locale])
    })

    return { value, isMissingTranslation }
}

export function isFilled(value: unknown): boolean {
    if (value === null || value === undefined) {
        return false
    }

    return typeof value === 'string' ? value.trim() !== '' : true
}
