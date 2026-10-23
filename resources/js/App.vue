<script setup lang="ts">
import { onMounted } from 'vue'
import { useModulesStore } from './stores/modules'

const modulesStore = useModulesStore()

onMounted(() => modulesStore.loadModules())
</script>

<template>
    <div class="app">
        <nav class="nav" aria-label="Navigation principale">
            <RouterLink :to="{ name: 'home' }" class="brand">
                <svg width="22" height="22" viewBox="0 0 22 22" aria-hidden="true">
                    <rect x="1" y="1" width="20" height="20" rx="5" fill="var(--accent)" />
                    <path d="M6 15l5-9 5 9M8.2 11.5h5.6" stroke="var(--accent-ink)" stroke-width="1.8" fill="none" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                AdminPhp
            </RouterLink>

            <div class="nav-group">
                <h3>Contenus</h3>
                <RouterLink
                    v-for="module in modulesStore.modules"
                    :key="module.name"
                    :to="{ name: 'module.index', params: { module: module.name } }"
                    class="nav-link"
                >
                    {{ module.title }} <small>{{ module.count }}</small>
                </RouterLink>
            </div>
        </nav>

        <RouterView :key="$route.fullPath" />
    </div>
</template>
