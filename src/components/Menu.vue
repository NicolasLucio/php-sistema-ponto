<template>     
    <v-navigation-drawer    
        permanent        
        location="left"
    >
        <template v-slot:prepend>
            <div>
                <!-- Trocar se estiver logado -->
                <v-list>
                    <v-list-item
                        prepend-icon="mdi-home"
                        title="Home"
                        to="/home"
                    >
                    </v-list-item>
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
                    prepend-icon="mdi-security"
                    title="Painel Admin"
                    to="/adm"
                >
            </v-list-item>        
        </v-list>

        <template v-slot:append>
            <!-- Esconder se não estiver logado -->
            <div class="px-5">
                <v-btn
                    class="mb-2"                
                    color="red"
                    size="small"    
                    block            
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

</script>