<template>     
    <v-navigation-drawer    
        permanent        
        :location="(data.width > 600) ? 'left' : 'right'"
        :rail="menuRail"
    >
        <template v-slot:prepend>
            <div v-resize="onResize">
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
                v-if="piniaValue.isLogged"
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
                :class="(!menuRail) ? 'px-5' : ''"
            >
                <v-btn
                    v-if="!menuRail"
                    class="mb-2"                
                    color="red"
                    size="small"    
                    block
                    @click="dialogLogoff = true"
                >Logout</v-btn>
                <v-btn
                    v-else                    
                    color="red mx-2"
                    size="small"                        
                    icon="mdi-logout"
                    @click="dialogLogoff = true"
                ></v-btn>
            </div>
            <v-divider></v-divider>
            <div class="pa-2">
                <p 
                    v-if="!menuRail"
                    class="ext-disabled text-center text-subtitle-2"
                >
                    Empresa X - 2023
                </p>
                <p
                    v-else
                    class="ext-disabled text-center text-subtitle-2"
                >
                    2023
                </p>
            </div>
        </template>
    </v-navigation-drawer>
    <v-dialog
        v-model="dialogLogoff"
        persistent
        width="auto"
    >
        <v-card>
            <v-card-title class="text-h5 text-center">
                LOGOUT
            </v-card-title>
                <v-card-text>
                    Tem certeza que quer se desconectar do sistema?
                </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="red"                    
                    @click="dialogLogoff = false"
                >
                    Não
                </v-btn>
                <v-btn
                    color="blue-darken-1"
                    variant="outlined"
                    @click="changeLogged(false)"
                >
                    Sim
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    import { reactive, onMounted } from 'vue';
    import pinia, { useDefinitionStore } from '../assets/js/pinia';

    export default {
        data () {
            return {
                dialogLogoff: false,
                menuRail: false,
                data: reactive({
                    widht: 0,
                    height: 0
                })
            }
        },
        setup() {
            const piniaValue = useDefinitionStore()    
            return { piniaValue }
        },

        mounted(){
            this.onResize()            
        },
        methods: {
            changeLogged(to){
                this.piniaValue.isLogged = to
                this.dialogLogoff = false
                if (!to)
                {
                    document.location.href = '/home'
                }
            },
            onResize(){
                this.data.width = window.innerWidth
                if (this.data.width > 600)
                {
                    this.menuRail = false;
                }
                else
                {
                    this.menuRail = true;
                }
            }            
        }
    }   
</script>
