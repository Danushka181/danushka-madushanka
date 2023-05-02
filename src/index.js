import { createApp } from "vue";
import App from "./vue/App.vue"; 
import router from "./vue/Routes/Routes.vue";
import i18n from './vue/i18n/i18n.js';
import store from "./vue/store/store";

import './assets/scss/style.scss';


const app = createApp(App);
app.use(router);
app.use(i18n);
app.use(store);
app.mount("#dm_admin_view");
