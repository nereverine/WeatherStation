<template>
  <v-sheet>
    <v-container fluid>
      <v-row align="center" justify="center">
        <h1 class="text-center display-3">User Profile</h1>
      </v-row>

      <v-card max-width="50%" class="mx-auto my-12">
        <v-row>
          <v-col align="left"
            ><v-card-title class="display-1" :rules="[rules.name]">
              Name:
            </v-card-title>
          </v-col>
          <v-col align="right">
            <v-text-field class="x-medium" v-model="name"></v-text-field>
          </v-col>
        </v-row>
        <v-divider class="mx-4"></v-divider>
        <v-row>
          <v-col align="left"
            ><v-card-title class="display-1"> New Password: </v-card-title>
          </v-col>
          <v-col align="right">
            <v-text-field
              class="x-medium"
              v-model="password"
              :type="show ? 'text' : 'password'"
              :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
              :rules="[rules.min]"
              @click:append="show = !show"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-divider class="mx-4"></v-divider>
        <v-card-actions>
          <v-row>
            <v-col align="center">
              <v-btn class="success" @click="update">Update</v-btn>
            </v-col>
          </v-row>
        </v-card-actions>
      </v-card>
    </v-container>
  </v-sheet>
</template>

<script>
export default {
  data() {
    return {
      name: this.$store.getters.user.name,
      password: "",
      show: false,
      rules: {
        required: (value) => !!value || "Required.",
        min: (v) => v.length >= 3 || "Min 3 characters",
        name: (value) =>
          (value &&
            /^[a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ][a-zA-ZáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s]*$/.test(
              value
            )) ||
          "Name must be only letters and spaces",
        emailValid: (value) =>
          (value && /.+@.+/.test(value)) ||
          'E-mail must be valid: "example@mail.com"',
      },
    };
  },

  methods: {
    update() {
      if (this.password == "") {
        console.log("nao tem pass");
        axios.post("api/updateUser/" + this.$store.getters.user.id, {
              userId: this.$store.getters.user.id,
              name: this.name,
            }).then((response) => {
                this.$router.push("/", ()=>{})
            });
      } else {
        console.log("tem pass");
        // const bcrypt = require("bcryptjs");
        // const saltRounds = 10;
        // const password = this.password;
        // bcrypt.genSalt(saltRounds, function (err, salt) {
        //   bcrypt.hash(password, salt, function (err, hash) {
            axios.post("api/updateUserWithPass/" + this.$store.getters.user.id, {
              userId: this.$store.getters.user.id,
              name: this.name,
              password: this.password
            }).then((response) => {
                console.log("Password changed")
                this.$router.push("/", ()=>{})
            });
        //   });
        // });
      }

      console.log("aqui");

      // axios.post("api/updateUser/" + this.$store,getters.user.id, {
      //     userId: this.$store.getters.user.id,
      //     name: this.name,

      // })
    },
  },
};
</script>

<style>
</style>