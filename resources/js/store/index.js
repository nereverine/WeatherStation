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
                       
                state.user = value
            
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
            axios.post('/api/login',{
                email: payload.email,
                password: payload.password,
            },) 
            .then(response => {
              localStorage.setItem('user', JSON.stringify(response.data));    
              commit('setUser', response.data)
              commit('setAuthenticated', true)
            }) 
            .catch((error) => {
                console.log(error)
                commit('setUser', null)
                commit('setAuthenticated', false)
            }
            )
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