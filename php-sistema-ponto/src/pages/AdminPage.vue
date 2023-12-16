<template>
    <div class="mb-10">
        <v-card
            class="mx-auto"
            max-width="700"
            variant="outlined"
            :color="(editMode) ? 'cyan' : ''"
        >
            <v-card-title class="text-center mb-2">
                Painel
            </v-card-title>
            <v-card-text>
                <p class="my-3 text-center">{{ txtHeader }}</p>
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
                    v-if="editMode"
                    class="mx-2"
                    color="red"
                    variant="tonal"                    
                    icon="mdi-window-close"
                    @click="closeEditMode()"
                >
                </v-btn>
                <v-btn
                    class="mx-2"
                    color="info"
                    variant="tonal"
                    size="large"
                    type="submit"
                    form="createForm"
                >
                    {{ txtButton }}
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
                        <th>
                            Ações
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
                        <td>
                            <v-menu>
                                <template v-slot:activator="{ props }">
                                    <v-btn
                                        class="d-flex justify-space-around"
                                        color="primary"
                                        v-bind="props"
                                        icon="mdi-square-edit-outline"
                                        size="x-small"
                                    >                                        
                                    </v-btn>
                                </template>
                                <v-list>
                                    <v-list-item
                                        title="Editar"                                        
                                        @click="requestEdit(item.id)"                               
                                    >
                                    </v-list-item>
                                    <v-list-item
                                        title="Deletar"
                                        @click="requestDelete(item.id, item.username)"
                                    >
                                    </v-list-item>
                                </v-list>
                            </v-menu>
                        </td>
                    </tr>
                </tbody>
            </v-table>
        </v-card-text>
    </v-card>

    <!-- MODAL -->

    <v-dialog
        v-model="dialogDelete"
        persistent
        width="auto"
    >
        <v-card>
            <v-card-title class="text-h5 text-center">
                Deletar
            </v-card-title>
                <v-card-text>
                    Tem certeza que quer deletar o usuário?
                    <p class="text-center" style="color: green">
                        <b>{{ selectedUsername }}</b>
                    </p>                    
                </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                    color="red"                    
                    @click="cleanRequest()"
                >
                    Não
                </v-btn>
                <v-btn
                    color="blue-darken-1"
                    variant="outlined"
                    @click="deleteSelectedUser(selectedID)"
                >
                    Sim
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <v-dialog
        v-model="dialogInfomation"
        persistent        
        width="auto"
    >
        <v-card color="primary">
            <v-card-text>
                {{ dialogInfomationText }}
            </v-card-text>   
            <v-progress-linear
                indeterminate
                color="white"
                class="mb-1"
            ></v-progress-linear>         
        </v-card>
    </v-dialog>
</template>

<script>
    import { useDefinitionStore } from '../assets/js/pinia'

    export default{
        data: () => ({
            objectUsers: null,
            temporaryObject: null,
            editMode: false,
            username: "",
            nome: "",
            password: "",
            checkbox: false,
            dialogDelete: false,
            dialogInfomation: false,
            dialogInfomationText: '',
            selectedUsername: '',
            selectedID: null,            
            temporaryID: 0,
            txtButton: '',
            txtHeader: '',
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

        watch: {
            dialogInfomation (val){
                if (!val) return
                setTimeout(() => (this.dialogInfomation = false), 2000)
            }
        },

        created(){
            this.refreshUserList();
            this.updateFormText(false);
        },

        methods:{
            refreshUserList(){
                this.axios.post('http://localhost:8080/adminlist.php', {}).then((response) => {
                    console.log("Resposta Admin Page = " + response.data.message)
                    this.objectUsers = response.data.listUsers
                })
            },

            updateFormText(edit)
            {
                if(edit)
                {                   
                    this.txtHeader = "Editar usuário";
                    this.txtButton = "Concluir Edição"
                }                
                else
                {                    
                    this.txtHeader = "Cadastrar um novo usuário";
                    this.txtButton = "Cadastrar"
                }
                this.editMode = edit;                
            },

            createSubmit(event){
                event.preventDefault()
                if (this.editMode == false)
                {
                    this.axios.post('http://localhost:8080/admincreate.php', {
                        username:this.username,
                        nome:this.nome,
                        password:this.password,
                        checkbox:this.checkbox            
                    }).then((response) => {
                        console.log("Resposta Add Admin = " + response.data.message)
                        this.requestDialogInformation(true);
                        this.cleanForm()
                        this.refreshUserList()
                    })
                }
                else
                {                    
                    console.log("submit editar");
                    this.axios.post('http://localhost:8080/edit.php' , {
                        username:this.username,
                        nome:this.nome,
                        password:this.password,
                        checkbox:this.checkbox
                    }).then((response) => {
                        console.log("Resposta Edit = " + response.data.message)
                        this.requestDialogInformation(false);
                        this.closeEditMode()
                        this.refreshUserList()
                    })
                }                
            },

            requestDialogInformation(create){
                if (create)
                {
                    this.dialogInfomationText = "Usuário Criado";
                }
                else
                {
                    this.dialogInfomationText = "Usuário Editado";
                }
                this.dialogInfomation = true;
            },

            requestDelete(userID, userName){
                this.selectedID = userID;
                this.selectedUsername = userName;
                this.dialogDelete = true;
            },

            requestEdit(userID)
            {   
                this.selectedID = userID;
                this.editGetInfo(userID);
            },

            cleanRequest(){
                this.dialogDelete = false;
                this.selectedID = null;
                this.selectedUsername = '';
            },

            cleanForm(){
                this.temporaryID = 0;

                this.username = '';
                this.nome = '';
                this.password = '';

                this.checkbox = false;
            },

            closeEditMode(){
                this.cleanRequest();
                this.cleanForm();
                this.updateFormText(false);                
            },

            deleteSelectedUser(userID){
                this.axios.post('http://localhost:8080/del.php', {
                    userID:userID,
                }).then((response) => {
                    console.log("Resposta Del = " + response.data.message)
                    this.cleanRequest();
                    this.refreshUserList();
                })
            },

            editGetInfo(userID){
                this.axios.post('http://localhost:8080/editinfo.php', {
                    userID:userID,
                }).then((response) => {
                    console.log("Resposta Edit Info = " + response.data.message)
                    this.temporaryObject = response.data.listInfo[0]
                    this.showResultInfo()
                })
            },
            
            showResultInfo()
            {
                if (this.temporaryObject != null)
                {
                    this.temporaryID = this.temporaryObject.id;

                    this.username = this.temporaryObject.username;
                    this.nome = this.temporaryObject.nome;
                    this.password = this.temporaryObject.senha;                    

                    if (this.temporaryObject.admin == 0)
                    {
                        this.checkbox = false;    
                    }
                    else if (this.temporaryObject.admin == 1)
                    {
                        this.checkbox = true;
                    }
                    this.updateFormText(true);
                }      
            }            
        }
    }
</script>
