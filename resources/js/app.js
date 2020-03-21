import Vue from "vue"
import Vuetify from "vuetify"
import "es6-promise/auto"
import axios from "axios"
import "./bootstrap"
import VueAuth from "@websanova/vue-auth"
import VueAxios from "vue-axios"
import VueRouter from "vue-router"
import auth from "./auth"
import router from "./router"

// Use vuetify
Vue.use(Vuetify)

// Set Vue globally
window.Vue = Vue

// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// Set Vue authentication
Vue.use(VueAxios, axios)
window.axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api/v1`
window.axios = axios

Vue.use(VueAuth, auth)

// Set global eventbus
window.EventBus = new Vue()

// Load Index
Vue.component("index", require("./Index.vue").default)

const app = new Vue({
	el: "#app",
	vuetify: new Vuetify(),
	router
})
