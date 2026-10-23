<script setup lang="ts">
import { useModulesStore } from '../stores/modules'

const modulesStore = useModulesStore()
</script>

<template>
    <main class="page">
        <header class="top">
            <div class="crumbs"><strong>Tableau de bord</strong></div>
        </header>

        <div class="page-body">
            <p v-if="modulesStore.modules.length === 0" class="empty">Aucun module enregistré.</p>

            <ul v-else class="cards">
                <li v-for="module in modulesStore.modules" :key="module.name">
                    <RouterLink :to="{ name: 'module.index', params: { module: module.name } }" class="card">
                        <span class="card-count">{{ module.count }}</span>
                        <span class="card-title">{{ module.title }}</span>
                    </RouterLink>
                </li>
            </ul>
        </div>
    </main>
</template>
