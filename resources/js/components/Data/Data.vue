<template>
<v-sheet>
        <v-container>
            <v-row
                align="center"
                justify="center"
            >
                <h1 class="text-center display-3">Sensor Data</h1>
            </v-row>

                    <v-skeleton-loader class="mx-auto" type="table"  v-if="firstLoad" :loading="loading"></v-skeleton-loader>

                        <v-card outlined >  
                        </v-card>
            <div >
                Welcome {{this.$store.getters.user.name}}
            </div>
        </v-container>
    </v-sheet>
    
</template>

<script>
export default {
    data() {
        return {
        firstLoad: true,
        loading: true,
        }
    },

   mounted(){
        setTimeout(()=>{
            this.loading = false;
            this.firstLoad = false;  
        },3000)
    }
};

</script>
