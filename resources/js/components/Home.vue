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
            aqui vai estar o logging?

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
        }
    },
    computed: {
        
    },
    methods:{


    },
    mounted(){
        setTimeout(()=>{
            this.loading = false;
            this.firstLoad = false;
        },3000)
    }
}
</script>

<style scoped>

</style>
