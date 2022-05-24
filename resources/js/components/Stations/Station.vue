<template>
    <v-container fluid>
            <v-row
                align="center"
                justify="center"
            >
                <h1 class="text-center display-3">Stations</h1>
                 <v-row v-if="isStationsEmpty" align="center" justify="center" class="mt-5">
            <h3 class="text-center">User has no stations</h3>
        </v-row>

    <v-col md="3" offset-lg="1">
        <v-row>
            <v-col v-for="station in stations" :key="station.id">
                <v-card class="mx-auto" max-width="100%">
                    <v-card-title>{{station.name}} </v-card-title>
                    <v-chip
      class="ma-2"
      :color= statusColor(station.status)
      text-color= "white"
    >
      {{station.status}}
    </v-chip>
    <v-card-actions>
              <v-btn @click="showSensors(station)">
                  <v-icon>
                     mdi-video-input-antenna
                  </v-icon>
                Sensors
              </v-btn>
              <v-btn @click="setSelectedStationId(station.id)">
                   <v-icon>
                     mdi-view-list
                  </v-icon>
                Data
              </v-btn>
            </v-card-actions>
                </v-card>
            </v-col>
        </v-row>
    </v-col>
</v-row>


<v-dialog v-model="dialog">
    <v-card>
        <v-card-title>
            Sensors
        </v-card-title>
        <v-card-text>
        <v-card v-for="item in selectedStationSensors">
            <v-col>
                <v-text-field v-model="item.name"
                label="Sensor Name"
                disabled>
                </v-text-field>

                <v-text-field v-model="item.description"
                label="Sensor Description"
                disabled>
                </v-text-field>
                 <img :src="'storage/sensors/'+ item.photo_url + '.png'"  style="width: 100px; height: 100px" />
            </v-col>
        </v-card>
<v-spacer></v-spacer>
        </v-card-text>

    </v-card>

</v-dialog>

    </v-container>




</template>

<script>
export default {

    data(){
        return{
            stations:[],
            selectedStationSensorsId: [],
            selectedStationSensors: [],
            dialog: false,
            stationId: 0,
            isStationsEmpty: true
        }
    },



    created(){
        const config = {
            params: {
                id: this.$store.getters.user.id,
            },
        }
        axios.get('api/stationsByUserId',config).then((response)=>
        {
            response.data.forEach(element => {
                switch (element.status){
                    case 'I':
                        element.status = "Inactive";
                        break;
                    case 'A':
                        element.status = "Active";
                        break;
                    default:
                        break;
                }
                this.stations.push(element);
                if(this.stations !== ''){
                    this.isStationsEmpty = false
                }
            });
        });
    },

    methods:{
        statusColor(status){
            if(status=="Active"){
                return "green"
            }
            else{
            return "red"
            }
        },

        showSensors(station){
            this.selectedStationSensorsId = []
            this.selectedStationSensors = []
            this.dialog=true

            const config = {
                params: {
                    id: station.id,
                },
            }
            axios.get('api/sensorsByStation',config)
            .then((response) => {
                response.data.forEach(element => {
                    //this.selectedStationSensorsId.push(element.sensorId)
                    this.getSensor(element.sensorId)
                })
                console.log(this.selectedStationSensors)
            })
            .catch((response) => {
                console.log(response)
                this.selectedStationSensorsId = []
            })
        },

        getSensor(id){
            const config = {
                params: {
                    id: id,
                },
            }
             axios.get('api/sensorById',config)
             .then((response) => {
                 response.data.forEach(element => {
                     this.selectedStationSensors.push(element)
                 })
             })
        },


        setSelectedStationId(id){

            this.$store.dispatch('selectedStationId', {
                id: id,
            })
            this.$router.push('/Data')
        },



    }

}
</script>
