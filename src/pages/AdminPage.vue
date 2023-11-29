<template>
    <div class="mb-10">
        <v-card>
            <v-card-title class="text-center mb-2">
                Painel
            </v-card-title>
            <v-card-text>
                Criar um novo usuário
            </v-card-text>
        </v-card>    
    </div>
    <v-divider></v-divider>
    <v-card>        
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
                            Nome
                        </th>
                        <th>
                            Outra info
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            07
                        </td>
                        <td>
                            Carlinho
                        </td>
                        <td>
                            Homem
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card-text>
    </v-card>
</template>