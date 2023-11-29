import { createApp } from 'vue'
import Router from './assets/js/router.js'
import Vuetify from './assets/js/vuetify.js'
import Template from './pages/Template.vue'

import './assets/css/style.css'

const mainApp = createApp(Template)

mainApp.use(Router)
mainApp.use(Vuetify)
mainApp.mount('#app')
