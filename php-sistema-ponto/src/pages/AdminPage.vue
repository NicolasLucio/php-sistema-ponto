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
                <v-form id="createForm" name="createForm" @submit="createSubmit">
                    <v-text-field
                        v-model="username"
                        outline
                        label="Username"
                        type="text"
                        hint="Dado que será usado para o login do usuário"
                        required
                    >                    
                    </v-text-field>
                    <v-text-field
                        v-model="nome"
                        outline
                        label="Nome"
                        type="text"     
                        hint="Nome que aparecerá no ponto"
                        required
                    ></v-text-field>
                    <v-text-field                        
                        v-model="password"
                        outline
                        label="Password"
                        type="password"
                        hint="Senha do usuário"
                        required
                    >
                    </v-text-field>
                    <v-checkbox
                        v-model="checkbox"                        
                        label="Fornecer Adminstrador?"                        
                    ></v-checkbox>
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
                    form="createForm"
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
                    <tr
                        v-for="item in objectUsers"
                        :key="item.id"
                    >
                        <td>
                            {{ item.id }}
                        </td>
                        <td>
                            {{ item.username }}
                        </td>
                        <td>
                            {{ item.nome }}
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
            objectUsers: null,
            username: "",
            nome: "",
            password: "",
            checkbox: false
        }),

        setup() 
        {
            const piniaValue = useDefinitionStore()
            if (!piniaValue.isLogged && !piniaValue.isAdmin)
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
            this.refreshUserList();
        },

        methods:{
            refreshUserList(){
                this.axios.post('http://localhost:8080/adminlist.php', {}).then((response) => {
                    console.log("Resposta Admin Page = " + response.data.message)
                    this.objectUsers = response.data.listUsers
                })
            },
            createSubmit(event){
                event.preventDefault()
                this.axios.post('http://localhost:8080/admincreate.php', {
                    username:this.username,
                    nome:this.nome,
                    password:this.password,
                    checkbox:this.checkbox            
                }).then((response) => {
                    console.log("Resposta Add Admin = " + response.data.message)
                    this.refreshUserList()
                })
            }
        }
    }
</script>
