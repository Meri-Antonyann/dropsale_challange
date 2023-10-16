import './bootstrap';

import axios from 'axios';
import VueAxios from 'vue-axios';
import * as router from 'vue-router';
import { createApp } from 'vue';
import App from './App.vue';


createApp(App).use(VueAxios, axios).use(router).mount('#app');