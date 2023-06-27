import { createApp } from 'vue'
import './style.css'
import App from './App.vue'
import router from './router'
import {createStore} from 'vuex'

const app =  createApp(App)
const store = createStore({
    state: {
        editingEquipment: null
    },
    getters: {
        EDITING_EQUIPMENT(state) {
            return state.editingEquipment
        }
    },
    actions: {
        HANDLE_EDIT_BTN_CLICK({commit}, equipment) {
            commit('SET_EDITING_EQUIPMENT', equipment)
        }
    },
    mutations: {
        SET_EDITING_EQUIPMENT: (state, equipment) => {
            state.editingEquipment = equipment
        }
    }
})

app.use(router)
app.use(store)

app.mount('#app')
