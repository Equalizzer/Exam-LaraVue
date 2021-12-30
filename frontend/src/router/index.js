import Vue from 'vue';
import Router from 'vue-router';
import Home from "../pages/Home";
import authRoutes from "../pages/auth/auth-routes";
import userRoutes from "../pages/user/user-routes"
import Verified from "../components/Verified";

Vue.use(Router);

export default new Router({
  mode:'history',
    routes: [
        {
            mode: 'history',
            path: '/',
            name: 'Home',
            component: Home
        },
        ...authRoutes,
        ...userRoutes,
      {path: '/verify', name: 'Verified', component: Verified}
    ]
});
