import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

import Login from "../components/Auth/Login"
import Register from "../components/Auth/Register"
import Home from "../components/Home"
import Station from "../components/Stations/Station"
import Data from "../components/Data/Data"

export default new Router ({
   // mode: "history",
    routes: [
        {
             path: '/',
             redirect: '/Home',
        },

        {
            path: '/Home',
            name: 'Home',
            component: Home,
        },
        
        {
            path: '/Login',
            name: 'Login',
            component: Login,
        },

        {
            path: '/Station',
            name: 'Station',
            component: Station,
        },

        {
            path: '/Data',
            name: 'Data',
            component: Data,
        },

        

    ]
})