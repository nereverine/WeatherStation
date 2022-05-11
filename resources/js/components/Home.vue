<template>
    <v-sheet>
        <v-container>
            <v-row
                align="center"
                justify="center"
            >
                <h1 class="text-center display-3">{{title}}</h1>
            </v-row>

                    <v-skeleton-loader class="mx-auto" type="card" v-if="firstLoad" :loading="loading"></v-skeleton-loader>

                        <v-card outlined v-if="!firstLoad" :loading="loading">  
                        </v-card>
            <div v-if="isUserAuthenticated">
                Welcome {{this.$store.getters.user.name}}
            </div>
        </v-container>
    </v-sheet>
</template>

<script>
export default {
    data() {
        return {
            title: 'Welcome to WeatherStation@AnytimeAnywhere',
            loading: true,
            firstLoad: true,
            user: {},
        }
    },
    computed: {
        isUserAuthenticated(){
            return this.$store.getters.authenticated
        },
        getUser(){
            this.user = this.$store.getters.user
        }
        
    },
    methods:{


    },
    mounted(){
        setTimeout(()=>{
            this.loading = false;     
        },3000)
    }
}
</script>

<style scoped>

</style>
