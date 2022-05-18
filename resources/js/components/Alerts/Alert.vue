<template>
  <v-sheet>
    <v-container fluid>
      <v-row align="center" justify="center">
        <h1 class="text-center display-3">Alerts</h1>
        <v-row>
            <v-col align="right">
              <v-btn color="green" @click="addAlertOpen()">
                <v-icon>mdi-plus-thick</v-icon>
                  Add</v-btn>
                  <v-btn color="red">
                <v-icon>mdi-close-thick</v-icon>
                  Remove</v-btn>
            </v-col>
        </v-row>
        <v-row
          v-if="isAlertsEmpty"
          align="center"
          justify="center"
          class="mt-5"
        >
          <h3 class="text-center">User has no alerts</h3>
        </v-row>
        <v-col>
          <v-row class="mt-5">
            <v-col v-for="alert in alerts" :key="alert.id" sm="6" cols="3"
                        md="4">
              <v-card max-width="100%">
                <v-card-title class="justify-center">{{ alert.condition }} </v-card-title>
              </v-card>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>

<v-dialog v-model="dialog" max-width="20%">
  <v-card>
  <v-card-title>
    Add Alert
  </v-card-title>
  <v-card-text>
  <v-select
          :items="items"
          label="Alert"
          v-model="selectedAddAlert"
        ></v-select>
        <v-row>
          <v-col align="right">
         <v-btn align="right" color="green" @click="addAlert()">Add alert</v-btn>
          </v-col>

          <v-col align="right">
         <v-btn align="right" color="blue" @click="teste()">TESTE</v-btn>
          </v-col>
        </v-row>
  </v-card-text>
 
</v-card>
</v-dialog>

  </v-sheet>
</template>

<script>
export default {
  data() {
    return {
      alerts: [],
      isAlertsEmpty: true,
      hasHumidityAlert: false,
      hasTemperatureAlert: false,
      hasLuminosityAlert: false,
      dialog: false,
      items: ['temperature>22', 'humidity>90', 'luminosity>500'],
      selectedAddAlert: '',
    };
  },

  created() {
    const config = {
      params: {
        userId: this.$store.getters.user.id,
      },
    };
    axios.get("api/getAlerts", config).then((response) => {
      response.data.forEach((element) => {
        this.alerts.push(element);
        if (this.alerts !== "") {
          this.isAlertsEmpty = false;
        }
      });
    });
  },

  methods:{

    addAlertOpen(){
      this.dialog = true
    },

    addAlert(){
       
        axios.post('api/createAlert', {
          userId: this.$store.getters.user.id,
          condition: this.selectedAddAlert,
        })
        .then((response) => {
          console.log(response.data)
        });
    },

    teste(){
      axios.post('api/sendHighTempNotif')
      .then((response) => {
        console.log(response.data)
      })
    }

  },
};
</script>
