require('./bootstrap');

import Vue from "vue";
import App from "./App.vue";
import router from "./router/index.js";
import store from "./store/index.js";
import VueTailwind from "vue-tailwind";
import Vuelidate from "vuelidate";
import CKEditor from "@ckeditor/ckeditor5-vue";
import FlashMessage from '@smartweb/vue-flash-message';

Vue.use(VueTailwind);
Vue.use(Vuelidate);
Vue.use(CKEditor);
Vue.use(FlashMessage);

import "./assets/styles/index.css";

// Globally register all `_base`-prefixed components
import "./components/_globals";

import { library } from "@fortawesome/fontawesome-svg-core";
import { faHandshake } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

library.add(faHandshake);

Vue.component("font-awesome-icon", FontAwesomeIcon);

Vue.config.productionTip = false;

window.VueGlobal = new Vue({
    router,
    store,
    render: (h) => h(App),
}).$mount("#app");

window.VueGlobal.flashMessage.setStrategy('multiple');
