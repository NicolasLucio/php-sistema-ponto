import { createRouter, createWebHistory } from "vue-router"
import HomePage from '../../pages/HomePage.vue'
import AdminPage from '../../pages/AdminPage.vue'
import HistoryPage from '../../pages/HistoryPage.vue'

const routes = [
    {
        path: '/',
        component: HomePage,
        alias: ['/home']
    },
    {
        path: '/admin',
        component: AdminPage,
        alias: ['/adm']
    },
    {
        path: '/history',
        component: HistoryPage,
        alias: ['/list']
    }
]

export default createRouter({
    history: createWebHistory(),
    routes
})