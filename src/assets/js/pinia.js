import { createPinia, defineStore } from 'pinia'

const pinia = createPinia()

export const useDefinitionStore = defineStore('config' , {
    state: () => (
        { 
            menu: true,
            isAdmin: true ,
            isLogged: true,
            loggedUsername: "Pedro Pedroso"
        }
    )
})
export default pinia