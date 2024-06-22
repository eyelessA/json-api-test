import { createApp } from "vue";
import Index from "./components/Index.vue";
import router from "./router.js";
import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

const app = createApp(Index); // Index является корневым компонентом

app.use(router);
app.mount('#app');