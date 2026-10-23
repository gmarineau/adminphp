import { createRouter, createWebHistory } from 'vue-router'
import { config } from './config'
import Home from './pages/Home.vue'
import ModuleForm from './pages/ModuleForm.vue'
import ModuleIndex from './pages/ModuleIndex.vue'

export const router = createRouter({
    history: createWebHistory(config.basePath),
    routes: [
        { path: '/', name: 'home', component: Home },
        { path: '/:module', name: 'module.index', component: ModuleIndex, props: true },
        { path: '/:module/create', name: 'module.create', component: ModuleForm, props: true },
        { path: '/:module/:id', name: 'module.edit', component: ModuleForm, props: true },
    ],
})
