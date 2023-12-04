<template>
    <v-card
        class="mx-auto"
        max-width="700"
    >
        <v-toolbar>
            <template v-slot:prepend>
                <v-btn 
                    icon="mdi-refresh"
                    @click="historyRefresh()"
                >
                </v-btn>
            </template>
            <v-toolbar-title class="text-h6">
                Histórico
            </v-toolbar-title>
        </v-toolbar>              
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
                            Horário
                        </th>
                        
                    </tr>                    
                </thead>
                <tbody>
                    <tr
                        v-for="item in objectHistory"
                        :key="item.data"
                    >
                        <td>
                            {{  item.data }}
                        </td>
                        <td>
                            {{ item.hora }}:{{ item.minuto }}
                        </td>                        
                    </tr>
                </tbody>
            </v-table>
        </v-card-text>
    </v-card>    
</template>

<script>    
    import { useDefinitionStore } from '../assets/js/pinia'

    export default{
        data: () => ({
            objectHistory: null,
        }),

        setup() {
            const piniaValue = useDefinitionStore()
            if (!piniaValue.isLogged)
            {
                document.location.href = '/home'
                return null
            }
            else
            {
                return { piniaValue }
            }                                 
        },

        created(){
            this.historyRefresh();
        },

        methods:{     
            historyRefresh(){
                this.axios.post('http://localhost:8080/history.php', {
                    userID:this.piniaValue.loggedUserID
                }).then((response) => {
                    console.log("Reposta History = " + response.data.message)
                    this.objectHistory = response.data.listHistory                                 
                }) 

            }
        }
    }

</script>
