import { defineStore } from 'pinia'
import { ref } from 'vue'
import { api } from '../api'
import type { ModuleSchema, ModuleSummary } from '../types'

export const useModulesStore = defineStore('modules', () => {
    const modules = ref<ModuleSummary[]>([])
    const schemas = ref<Record<string, ModuleSchema>>({})

    async function loadModules(): Promise<void> {
        modules.value = await api.modules()
    }

    async function schema(name: string): Promise<ModuleSchema> {
        schemas.value[name] ??= await api.module(name)

        return schemas.value[name]
    }

    return { modules, loadModules, schema }
})
