// src/main.js

import { createApp } from 'vue';
import router from './routers/index.js';
import Default from './layouts/LayoutUser/index.vue'
import Admin from './layouts/LayoutAdmin/index.vue'
import App from './App.vue';
import { createPinia } from 'pinia'
import axios from 'axios';



const app = createApp(App);
app.use(createPinia());
app.use(router);
app.component("default-layout", Default)
app.component("admin-layout",Admin)
app.mount('#app');
axios.interceptors.request.use(config => {
    const token = localStorage.getItem('token'); // Nếu backend trả về token
    if (token) {
      config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
  });