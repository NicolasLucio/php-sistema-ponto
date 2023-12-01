import { createPinia, defineStore } from 'pinia'

const pinia = createPinia()

export const useDefinitionStore = defineStore('config' , {
    state: () => (
        { 
            menu: true,
            isAdmin: false ,
            isLogged: false,
            loggedUsername: ""
        }
    )
})
export default pinia