<template>
  <v-sheet>
    <v-container fluid>
      <v-row align="center" justify="center">
        <h1 class="text-center display-3">Alerts</h1>
        <v-row>
            <v-btn>teste</v-btn>
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
          <v-row>
            <v-col v-for="alert in alerts" :key="alert.id" class="mt-5">
              <v-card>
                <v-card-title>{{ alert.alert }} </v-card-title>
              </v-card>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
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
};
</script>
