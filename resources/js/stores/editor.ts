import { defineStore } from 'pinia'
import { ref } from 'vue'
import { config } from '../config'
import type { ValidationErrors } from '../types'

/**
 * State shared by every field of the form being edited.
 */
export const useEditorStore = defineStore('editor', () => {
    const locale = ref(config.defaultLocale)
    const errors = ref<ValidationErrors>({})

    function errorFor(path: string): string | null {
        return errors.value[path]?.[0] ?? null
    }

    return { locale, errors, errorFor }
})
