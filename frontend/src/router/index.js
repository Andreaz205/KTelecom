import { createRouter, createWebHistory } from 'vue-router'
import Index from "../views/Equipment/Index.vue";

const index = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'Index',
            component: Index
        },
        {
          path: '/create',
          name: 'CreateEquipment',
          component: () => import('../views/Equipment/Create.vue')
        },
        {
            path: '/edit/:id',
            name: 'EditEquipment',
            component: () => import('../views/Equipment/Edit.vue')
        }
    ]
})

export default index
