<template>
    <div class="mb-10">
        <v-card
            class="mx-auto"
            max-width="700"
            variant="outlined"
        >
            <v-card-title class="text-center mb-2">
                Painel
            </v-card-title>
            <v-card-text>
                <p class="my-3 text-center">Cadastrar um novo usuário</p>
                <v-form>
                    <v-text-field                        
                        outline
                        label="Username"
                        type="text"
                        hint="Dado que será usado para o login do usuário"
                    >                    
                    </v-text-field>
                    <v-text-field
                        outline
                        label="Nome"
                        type="text"     
                        hint="Nome que aparecerá no ponto"
                    ></v-text-field>
                    <v-text-field                        
                        outline
                        label="Password"
                        type="password"
                        hint="Senha do usuário"
                    >
                    </v-text-field>
                </v-form>                
            </v-card-text>
            <v-divider></v-divider>
            <v-card-actions class="mb-2">
                <v-spacer></v-spacer>
                <v-btn
                    class="mx-2"
                    color="info"
                    variant="tonal"
                    size="large"
                    type="submit"
                >
                    Cadastrar
                </v-btn>
            </v-card-actions>
        </v-card>    
    </div>
    <v-divider></v-divider>
    <v-card
        class="mx-auto"
        max-width="700"        
    >        
        <v-card-title class="text-center mb-2">
            Usuários Cadastrados
        </v-card-title>
        <v-card-text>            
            <v-table
                fixed-header
            >
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Username
                        </th>
                        <th>
                            Nome
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            07
                        </td>
                        <td>
                            carlimmmm
                        </td>
                        <td>
                            Carlos dos Campos
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card-text>
    </v-card>
</template>