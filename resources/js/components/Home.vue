<template>
    <v-sheet>
        <v-container>
            <v-row
                align="center"
                justify="center"
            >
                <h1 class="text-center display-3">{{title}}</h1>
            </v-row>
            <div v-if="isUserAuthenticated">

                <v-row align="center" justify="center">
               <h3 class="text-center"> Welcome {{this.$store.getters.user.name}}</h3>
                </v-row>
            </div>
            <v-img
  max-height="100%"
  max-width="100%"
  src="storage/background.jpg"
></v-img>
        </v-container>

    </v-sheet>
</template>

<script>
export default {
    data() {
        return {
            title: 'Welcome to WeatherStation@AnytimeAnywhere',

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
           // this.loading = false;
        },3000)
    }
}
</script>

<style scoped>

</style>
