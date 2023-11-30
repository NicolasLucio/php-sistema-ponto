import { createApp } from 'vue'
import Router from './assets/js/router.js'
import Vuetify from './assets/js/vuetify.js'
import Pinia from './assets/js/pinia.js'
import Axios from 'axios'
import VueAxios from 'vue-axios'
import Template from './pages/Template.vue'

import './assets/css/style.css'

const mainApp = createApp(Template)

mainApp.use(VueAxios, Axios)
mainApp.use(Pinia)
mainApp.use(Router)
mainApp.use(Vuetify)
mainApp.mount('#app')
