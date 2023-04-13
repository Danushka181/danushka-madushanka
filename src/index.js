import { createApp } from "vue";
import App from "./vue/App.vue"; 
import router from "./vue/Routes/Routes.vue";	

import './assets/scss/style.scss';


const app = createApp(App);
app.use(router);
app.mount("#dm_admin_view");
