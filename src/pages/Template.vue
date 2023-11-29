<template>
    <v-layout>
        <Menu></Menu>        
        <v-main>                        
            <div class="template-pading">
                <router-view></router-view>
            </div>
        </v-main>
    </v-layout>
</template>

<script> 
    import Menu from '../components/Menu.vue'
    export default {
        components: {
            Menu
        }
    }
    
</script>

<style scoped>
    .template-pading{
        margin: 10px;
        height: calc(100% - 20px);
    }  
</style>