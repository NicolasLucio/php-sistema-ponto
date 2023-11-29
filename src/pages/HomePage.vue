<template>
    <v-container>
        <div>
            <v-card
                class="mx-auto"
                max-width="600"
                variant="outlined"
            >
                <v-card-title class="text-center">
                    Login
                </v-card-title>
                <v-card-text>
                    <p class="my-3">Faça login pfv</p>
                    <v-form>
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
                    >Login</v-btn>
                </v-card-actions>
            </v-card>     
        </div>
        <div class="mt-5">
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
    export default {
        data: () => ({
            select: null,
            items: [
                'Entrada',
                'Almoço',
                'Saída',
            ]
        })
    }

</script>
