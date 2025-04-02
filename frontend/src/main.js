// src/main.js
import { createApp } from 'vue';
import App from './App.vue';
import router from './routers/index.js';
import "./assets/assets/js/libs/jquery-3.1.1.min.js";
import "./assets/bootstrap/js/bootstrap.min.js";
import "./assets/assets/js/app.js";



import ("https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap");
import "./assets/bootstrap/css/bootstrap.min.css";
import "./assets/assets/css/plugins.css";
import "./assets/plugins/apex/apexcharts.css";
import "./assets/assets/css/dashboard/dash_2.css";

const app = createApp(App);
app.use(router);
app.mount('#app');

