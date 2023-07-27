import { createApp } from "vue";
import App from "./App.vue";
import Store from "./store.js";
import Antd from "ant-design-vue";
import "ant-design-vue/dist/reset.css";
import BootstrapVue3 from 'bootstrap-vue-3'

createApp(App).use(Store).use(Antd).use(BootstrapVue3).mount("#app");
