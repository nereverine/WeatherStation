import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export const store = new Vuex.Store({

    state:{
        authenticated: false,
        user:null,
        token: localStorage.getItem('user-token') || '',
        loading: false,
    },


    mutations:{
        /**
         * Auth
         */
         setAuthenticated (state, value) {
            state.authenticated = value
        },

        setUser (state, value) {
            if (state.user !== value) {              
                state.user = value
            }
        },
        setToken(state, payload) {
            //Saves token on Vuex
            state.token = payload
            //Saves token on localStorage
            localStorage.setItem('user-token', payload)
        },
    },

    actions:{
         /**
         * Auth Functions
         */
          login({commit,dispatch}, payload){
            axios.post('api/login',{
                username: payload.email,
                password: payload.password,
            },)
                .then( response => {
                    console.log(response)
                   // commit('setToken', response.data.access_token)
                })
                .then(()=>{
                    //dispatch('auth')
                    commit('setLoading', false)
                })
                .catch((error) => {
                        commit('setLoading', false)
                        console.log(error)
                       // commit('setToken', '')
                        commit('setUser', null)
                    }
                )
        },

        auth({commit,dispatch,getters}){
            // const config = {
            //     headers: {'Authorization': "Bearer " + getters.token}
            // }
            axios.get('api/user')
                .then((response) => {
                    console.log(response)
                    commit('setAuthenticated', true)
                    //dispatch('buildLinks', response.data)
                    commit('setUser', response.data)
                })
                .catch((response) => {
                    console.log(response)
                    commit('setAuthenticated', false)
                    commit('setUser', null)
                })
        },
        logout({ commit, getters }) {
            commit('setLoading', true)
            // const config = {
            //     headers: {'Authorization': "Bearer " + getters.token}
            // }
            axios.post('api/logout')
                .then(response => {
                    commit('setAuthenticated', false)
                    commit('setUser', null)
                    commit('setLoading', false)
                })
                .catch(
                    (error) => {
                        console.log(error)
                        commit('setAuthenticated', false)
                        commit('setUser', null)
                        commit('setLoading', false)
                    }
                )
        },
    },

    getters:{
        /**
         * User
         */
        authenticated(state){
            return state.authenticated
        },
        user(state){
            return state.user
        },
        token(state){
            return state.token
        },

        loading(state){
            return state.loading
        },
    },

});