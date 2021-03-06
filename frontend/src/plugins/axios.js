import Vue from 'vue';
import axios from 'axios';
import VueAxios from "vue-axios";

axios.defaults.baseURL = "http://127.0.0.1:8000/api";
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('accessToken');

Vue.use(VueAxios, axios);
