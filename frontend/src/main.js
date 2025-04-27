// src/main.js

import { createApp } from "vue";
import router from "./routers/index.js";
import Default from "./layouts/LayoutUser/index.vue";
import Admin from "./layouts/LayoutAdmin/index.vue";
import { createPinia } from "pinia";
import App from "./App.vue";




const app = createApp(App);
const pinia = createPinia();

app.use(pinia);
app.use(router);
app.component("default-layout", Default);
app.component("admin-layout", Admin);
app.mount("#app");
