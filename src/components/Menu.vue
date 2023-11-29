<template>     
    <v-navigation-drawer    
        permanent        
        location="left"
    >
        <template v-slot:prepend>
            <div>
                <!-- Trocar se estiver logado -->
                <v-list>
                    <div v-if="piniaValue.isLogged">
                        <v-list-item                        
                            prepend-icon="mdi-home-account"
                            :title="piniaValue.loggedUsername"
                            to="/home"
                        ></v-list-item>
                    </div>
                    <div v-else>
                        <v-list-item                        
                            prepend-icon="mdi-home"
                            title="Home"
                            to="/home"
                        >
                        </v-list-item>
                    </div>                    
                </v-list>
            </div>                
        </template>

        <v-divider></v-divider>

        <!-- Esconder de não for Admin -->
        <v-list nav>
            <v-list-item
                prepend-icon="mdi-view-list"
                title="Historico"
                to="/list"
            >
            </v-list-item>
            <v-list-item
                    v-if="piniaValue.isLogged && piniaValue.isAdmin"
                    prepend-icon="mdi-security"
                    title="Painel Admin"
                    to="/adm"
                >
            </v-list-item>        
        </v-list>

        <template v-slot:append>
            <!-- Esconder se não estiver logado -->
            <div 
                v-if="piniaValue.isLogged"
                class="px-5"
            >
                <v-btn
                    class="mb-2"                
                    color="red"
                    size="small"    
                    block
                    @click="changeLogged(false)"
                >Logout</v-btn>
            </div>
            <div class="pa-2">
                <p class="ext-disabled text-center text-subtitle-2">
                    Empresa X - 2023
                </p>
            </div>
        </template>
    </v-navigation-drawer>        
</template>

<script>
    import { reactive, onMounted } from 'vue';
    import pinia, { useDefinitionStore } from '../assets/js/pinia';

    export default{
        setup() {
            const piniaValue = useDefinitionStore()
            console.log("isLogged = " + JSON.stringify(piniaValue.isLogged))
            return { piniaValue }
        },
        methods: {
            changeLogged(to){
                this.piniaValue.isLogged = to
            }
        }
    }   
</script>