// src/main.js
import { createApp } from 'vue';
import App from './App.vue';
import router from './routers/index.js';
import Default from './layouts/LayoutUser/index.vue'
import Admin from './layouts/LayoutAdmin/index.vue'

const app = createApp(App);
app.use(router);
app.component("default-layout", Default)
app.component("admin-layout",Admin)

app.mount('#app');

