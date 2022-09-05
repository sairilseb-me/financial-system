import './bootstrap';
import '../sass/app.scss'


import {createApp} from 'vue';
import { createPinia } from 'pinia'
import App from '../components/App.vue';
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import router from './router.js';

import { library } from "@fortawesome/fontawesome-svg-core";
import { fas } from "@fortawesome/free-solid-svg-icons";

library.add(fas);

const pinia = createPinia()

const app = createApp(App);

app.component('font-awesome-icon', FontAwesomeIcon);
app.use(router);
app.use(pinia);
app.mount('#app');