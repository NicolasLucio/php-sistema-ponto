import { createPinia, defineStore } from 'pinia'

const pinia = createPinia()

export const useDefinitionStore = defineStore('config' , {
    state: () => (
        { 
            menu: true,
            isAdmin: false ,
            isLogged: false,
            loggedUsername: "",
            loggedUserID: "",
            lastPointMessage: "Horario do Ultimo Ponto Cadastrado"
        }
    )
})
export default pinia