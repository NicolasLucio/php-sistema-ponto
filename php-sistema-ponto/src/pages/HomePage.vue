<template>
    <v-container>
        <div v-if="!piniaValue.isLogged">
            <v-card                
                class="mx-auto"
                max-width="600"
                variant="outlined"
            >
                <v-card-title class="text-center my-2">
                    Login
                </v-card-title>
                <v-card-text>                    
                    <v-form id="loginForm" name="loginForm" @submit="loginSubmit">
                        <v-text-field
                            v-model="username"
                            outline
                            label="Username"
                            type="text"                        
                        >
                        </v-text-field>
                        <v-text-field
                            v-model="password"
                            outline
                            label="Password"
                            type="password"                        
                        >
                        </v-text-field>
                    </v-form>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions class="mb-2">                
                    <v-btn 
                        class="mx-2"
                        color="info"
                        flat
                    >Esqueceu a senha?</v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                        class="mx-2"
                        color="info"
                        variant="tonal"
                        size="large"
                        type="submit"
                        form="loginForm"
                    >Login</v-btn>
                </v-card-actions>
            </v-card>     
        </div>
        <div v-else>
            <v-card
                class="mx-auto"
                max-width="600"
                variant="outlined"
            >                
                <v-card-title class="text-center">
                    Ultimo Ponto
                </v-card-title>
                <v-card-text class="text-center">
                    Horário do Ultimo Ponto do Usuário
                </v-card-text>
            </v-card>
            <v-card
                class="mx-auto mt-5"
                max-width="600"
                variant="outlined"
            >
                <v-card-title class="text-center">
                    Novo ponto
                </v-card-title>
                <v-card-text class="mt-2">                    
                    <v-form>
                        <v-select
                            v-model="select"
                            :items="items"
                            :rules="[v => !!v || 'É necessário selecionar um item']"                            
                            label="Tipo do Ponto"
                            required
                        >
                        </v-select>
                    </v-form>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions class="mt-2">                    
                    <v-btn
                        color="warning"
                        icon="mdi-help"
                    ></v-btn>
                    <v-spacer></v-spacer>
                    <v-btn
                        class="mx-2"
                        color="info"
                        variant="tonal"
                        size="large"
                        type="submit"                        
                    >Confirmar</v-btn>
                </v-card-actions>
            </v-card>
        </div>        
    </v-container>
</template>

<script>   
import { onMounted } from 'vue'
import { useDefinitionStore } from '../assets/js/pinia'
    export default {
        data: () => ({
            username: "",
            password: "",
            isAdmin: 0,
            select: null,
            items: [
                'Entrada',
                'Almoço',
                'Saída',
            ]
        }),

        setup() {
            const piniaValue = useDefinitionStore()
            console.log("Setup")     
            return { piniaValue }           
        },        

        methods:{
            loginSubmit(event){
                event.preventDefault()
                this.axios.post('http://localhost:8080/login.php', {
                    username:this.username,
                    senha:this.password
                }).then((response) => {
                    console.log("respost braba = " + response.data.username)
                    this.username = response.data.username;
                    this.isAdmin = response.data.isAdmin;
                    this.loginSuccess();
                })                
            },
            loginSuccess(){
                this.piniaValue.loggedUsername = this.username;
                this.piniaValue.isLogged = true;
                if (this.isAdmin == 0)
                {
                    this.piniaValue.isAdmin = false;
                }
                else
                {
                    this.piniaValue.isAdmin = true;
                }                
            }
        }
    }

</script>
