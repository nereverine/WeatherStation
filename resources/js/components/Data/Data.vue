<template>
  <v-sheet>
    <v-container>
      <v-row align="center" justify="center">
        <h1 class="text-center display-3">Sensor Data</h1>
      </v-row>
<v-row class="mb-10">
      <v-card>
          <v-card-title class="indigo white--text text-h5">
              Today's Measurements
          </v-card-title>
          <v-row class="pa-4" justify="space-between">
              <v-col>
                  <vue-svg-gauge
  :start-angle="-110"
  :end-angle="110"
  :value=this.today.humidity
  :separator-step="10"
  :min="0"
  :max="100"
  :gauge-color="[{ offset: 0, color: '#347AB0'}, { offset: 100, color: '#8CDFAD'}]"
  :scale-interval="0.1"
>
<div class="inner-text-above inner-text-above--4">
        {{this.today.humidity}}%
      </div>
<div class="inner-text inner-text--3">
        <span>Humidity</span>
      </div>
</vue-svg-gauge>
</v-col>

              <v-col>
               <vue-svg-gauge
  :start-angle="-110"
  :end-angle="110"
  :value=this.today.luminosity
  :separator-step="100"
  :min="0"
  :max="1000"
  :gauge-color="[{ offset: 0, color: 'yellow'}, { offset: 50, color: 'black'}]"
  :scale-interval="0.1"
>
<div class="inner-text--lum-above inner-text-lum-above--4">
        {{this.today.luminosity}}
      </div>
<div class="inner-text-lum inner-text-lum--3">
        <span>Luminosity</span>
      </div>
</vue-svg-gauge>
              </v-col>

              <v-col>
                 <vue-svg-gauge
  :start-angle="-110"
  :end-angle="110"
  :value=this.today.temperature
  :separator-step="0"
  :min="0"
  :max="40"
  :gauge-color="[{ offset: 20, color: '#005dfc'}, { offset: 20, color: '#fc0000'}]"
  :scale-interval="0.1"
>
<div class="inner-text--temp-above inner-text-temp-above--4">
        {{this.today.temperature}}
      </div>
<div class="inner-text-temp inner-text-temp--3">
        <span>Temperature</span>
      </div>
</vue-svg-gauge>
              </v-col>
          </v-row>
      </v-card>
</v-row>
<v-row class="mb-10">
      <v-date-picker width="100%" elevation="15" v-model="datePicker" @click:date="showDate"></v-date-picker>
</v-row>

<v-dialog v-model="dialog" max-width="60%">
<v-card>
<v-card-title>Data for {{this.selectedDate}}</v-card-title>
<v-card-text>
  <v-container>
    <v-row>
      <v-col>
        <v-card>
          <v-card-title>Humidity</v-card-title>

          <v-card-text>
            <v-row>
            <v-col cols="6" align="center">
          <v-img
            src="https://cdn-icons-png.flaticon.com/512/727/727790.png"
            width="92"
          ></v-img>
        </v-col>
        <v-col>
          <div class="text-h5">
            {{this.selectedDateData.humidity}}%
          </div>
        </v-col>
            </v-row>
          </v-card-text>

        </v-card>
      </v-col>
      <v-col>
        <v-card>
          <v-card-title>Luminosity</v-card-title>
           <v-card-text>
            <v-row>
            <v-col cols="6" align="center">
          <v-img
            src="https://cdn-icons-png.flaticon.com/512/73/73570.png"
            width="92"
          ></v-img>
        </v-col>
        <v-col>
          <div class="text-h5">
            {{this.selectedDateData.luminosity}}
          </div>
        </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col>
        <v-card>
          <v-card-title>Temperature</v-card-title>
          <v-card-text>
            <v-row>
            <v-col cols="6" align="center">
          <v-img
            src="https://cdn-icons-png.flaticon.com/512/1843/1843544.png"
            width="92"
          ></v-img>
        </v-col>
        <v-col>
          <div class="text-h6">
            {{this.selectedDateData.temperature}}ºC
          </div>
        </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</v-card-text>
</v-card>
</v-dialog>

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
      today: {},

      datePicker: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      selectedDate: '',
      selectedDateData: {},
      dialog: false,
      hasTempAlert: false,
      hasHumAlert: false,
      hasLumAlert: false,
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
      this.today = r.data
    });



  const config2 = {
      params: {
        userId: this.$store.getters.user.id,
      },
    };
    axios.get("api/getAlerts", config2).then((response) => {
      response.data.forEach((element) => {
        switch(element.condition){
          case 'temperature>22':
            this.hasTempAlert = true
            break

          case 'humidity>90':
            this.hasHumAlert = true
            break

          case 'luminosity>500':
            this.hasLumAlert = true
            break  
        }
      });
      

        if(this.hasTempAlert==true && this.today.temperature > 22){
          this.sendTempNotif()
        }
        if(this.hasHumAlert==true && this.today.humidity > 90){
          this.sendHumNotif()
        }
        if(this.hasLumAlert==true && this.today.luminosity > 500){
          this.sendLumNotif()
        }

    });




  },

  computed: {},

  watch: {},

  methods: {
    showDate(datePicker){
      var splitdatePicker = datePicker.split("-")
      var year = splitdatePicker[0]
      var month = splitdatePicker[1]
      var day = splitdatePicker[2]
      if(month.substring(0,1) == 0){
        month = month.slice(1)
      }
      if(day.substr(0,1) == 0){
        day = day.slice(1)
      }

    this.selectedDate = '/'+year+'/'+month+'/'+day
    const config = {
        params: {
            path: this.selectedDate
        },
    };
    axios.get("/api/dataByDate", config).then((r) => {
      this.selectedDateData = r.data
      if(!Object.keys(this.selectedDateData).length ==0){
      this.dialog = true
    }
    });
    
    
    },

    sendTempNotif(){
      axios.post('api/sendHighTempNotif')
      .then((response) => {
        this.$toasted.show("High Temperature Notification sent!", {
          color: "orange",
          duration: 2000,
          position: "top-center",
        })
        console.log(response.data)
      })
    },

    sendHumNotif(){
      axios.post('api/sendHighHumiNotif')
      .then((response) => {
        this.$toasted.show("High Humidity Notification sent!", {
          color: "orange",
          duration: 2000,
          position: "top-center",
        })
        console.log(response.data)
      })
    },

    sendLumNotif(){
      axios.post('api/sendLowLumNotif')
      .then((response) => {
        this.$toasted.show("Low Luminosity Notification sent!", {
          color: "orange",
          duration: 2000,
          position: "top-center",
        })
        console.log(response.data)
      })
    }

  },
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

  .inner-text-above {
    &--4{
      display: flex;
      justify-content: center;
      margin-top: 70px;
      font-size: 20px;
      color: blue;
      font-weight: bold;
    }
  }

  .inner-text {
    &--1, &--3, &--4 {
      display: flex;
      justify-content: center;
      margin-top: 20px;
      font-size: 20px;
      color: #215dde;
      font-weight: bold;

      span {
        max-width: 100px;
      }
    }

    &--3 {
      margin-top: 5px;
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
    &--4 {
      margin-top: 20px;
    }
  }


  .inner-text-lum-above {
    &--4{
      display: flex;
      justify-content: center;
      margin-top: 70px;
      font-size: 20px;
      color: #ffd500;
      font-weight: bold;
    }
  }

  .inner-text-lum-below {
    &--4{
      display: flex;
      justify-content: center;
      margin-top: 30px;
      font-size: 10px;
      color: #c6fc03;
      font-weight: bold;
    }
  }

  .inner-text-lum {
    &--1, &--3, &--4 {
      display: flex;
      justify-content: center;
      margin-top: 20px;
      font-size: 18px;
      color: #f7c12a;
      font-weight: bold;

      span {
        max-width: 100px;
      }
    }

    &--3 {
      margin-top: 5px;
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
    &--4 {
      margin-top: 20px;
    }
  }

   .inner-text-temp-above {
    &--4{
      display: flex;
      justify-content: center;
      margin-top: 70px;
      font-size: 20px;
      color: #fc2a00;
      font-weight: bold;
    }
  }

  .inner-text-temp {
    &--1, &--3, &--4 {
      display: flex;
      justify-content: center;
      margin-top: 20px;
      font-size: 16px;
      color: #e84220;
      font-weight: bold;

      span {
        max-width: 100px;
      }
    }

    &--3 {
      margin-top: 5px;
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
    &--4 {
      margin-top: 20px;
    }
  }

</style>
