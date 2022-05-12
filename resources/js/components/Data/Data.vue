<template>
  <v-sheet>
    <v-container>
      <v-row align="center" justify="center">
        <h1 class="text-center display-3">Sensor Data</h1>
      </v-row>

      <v-skeleton-loader
        class="mx-auto"
        type="table"
        v-if="firstLoad"
        :loading="loading"
      ></v-skeleton-loader>

      <v-card>
          <v-card-title class="indigo white--text text-h5">
              Todays Measurements
          </v-card-title>
          <v-row class="pa-4" justify="space-between">
              <v-col>
                  <vue-svg-gauge
  :start-angle="-110"
  :end-angle="110"
  :value="95"
  :separator-step="10"
  :min="0"
  :max="100"
  :gauge-color="[{ offset: 0, color: '#347AB0'}, { offset: 100, color: '#8CDFAD'}]"
  :scale-interval="0.1"
>
<div class="inner-text inner-text--3">
        <span>Humidity</span>
      </div>
</vue-svg-gauge>
</v-col>
              <v-col>2</v-col>
              <v-col>3</v-col>
          </v-row>
      </v-card>
    </v-container>
  </v-sheet>
</template>

<script>
import { VueSvgGauge } from "vue-svg-gauge";
export default {
    components: {
      VueSvgGauge
    },
  data() {
    return {
      firstLoad: true,
      loading: true,
      data: {},
      years: [],

      items: [
        {
          id: 1,
          name: "Years:",
          children: [
            { id: 2, name: "as: as" },
            { id: 3, name: "Chrome : app" },
            { id: 4, name: "Webstorm : app" },
          ],
        },
      ],
    };
  },

  mounted() {
    setTimeout(() => {
      this.loading = false;
      this.firstLoad = false;
    }, 3000);
  },

  created() {
    axios
      .get("/api/getYears")
      .then((r) => {
        console.log(r.data);
      })
      .catch((error) => {
        console.log(error);
      });

    var today = new Date();
    var dd = String(today.getDate());
    var mm = String(today.getMonth()+1); //January is 0!
    var yyyy = today.getFullYear();
    var path = '/'+yyyy+'/'+mm+'/'+dd
    const config = {
        params: {
            path: path
        },
    };
    axios.get("/api/todaysData", config).then((r) => {
      console.log(r.data);
    });
  },

  computed: {},

  watch: {},

  methods: {},
};
</script>

<style lang="stylus" scoped>
  h3 {
    margin: 40px 0 0;
  }

  .mini-gauge {
    margin: 0 auto;
    max-width: 240px;

    .inner-text {
      width: 100%;
      height: 100%;
    }
  }

  .inner-text {
    &--1, &--3 {
      display: flex;
      justify-content: center;
      margin-top: 85px;
      font-size: 20px;
      color: #215dde;
      font-weight: bold;

      span {
        max-width: 100px;
      }
    }

    &--3 {
      margin-top: 100px;
    }

    &--2 {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      color: #de3a21;
      font-weight: bold;

      span {
        max-width: 90px;
      }
    }
  }
</style>
