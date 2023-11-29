<template>
    <v-card
        class="mx-auto"
        max-width="700"
    >
        <v-card-title class="text-center">
            Historico
        </v-card-title>
        <v-card-text>
            <p class="mb-2 text-center">
                Historico dos últimos 10 pontos
            </p>
            <v-table>
                <thead>
                    <tr>
                        <th>
                            Dia
                        </th>
                        <th>
                            Tipo
                        </th>
                        <th>
                            Horário
                        </th>
                    </tr>                    
                </thead>
                <tbody>
                    <tr>
                        <td>
                            20/10
                        </td>
                        <td>
                            Almoço
                        </td>
                        <td>
                            12:07 AM
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card-text>
    </v-card>    
</template>