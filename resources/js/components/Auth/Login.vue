<template>
    <v-container fluid>
        <v-row
            align="center"
            justify="center"
        >
            <v-col
                cols="12"
                sm="8"
                md="4"
            >
                <v-card class="elevation-10">
                    <v-form @submit.prevent="onLogin">
                        <v-toolbar
                            white
                        >
                            <v-toolbar-title>Login</v-toolbar-title>

                        </v-toolbar>
                        <v-card-text>
                            <v-text-field
                                label="Email"
                                name="email"
                                prepend-icon="person"
                                type="email"
                                v-model="email"
                            />
                            <v-text-field
                                id="password"
                                label="Password"
                                name="password"
                                prepend-icon="lock"
                                type="password"
                                v-model="password"
                            />
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer/>
                            <v-btn type="submit"
                                   :loading="loading"
                                   @click.native="loader = 'loading'"
                                   :disabled="loading">Login</v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data() {
        return {
            email: '',
            password: '',
        }
    },
    computed: {
        loading() {
            return this.$store.getters.loading
        },
        user () {
            return this.$store.getters.user
        },
    },
    watch :{
        user (value) {
            if (value !== null && value !== undefined){
                this.$router.push('/home')
            }
        },
    },
    methods: {
        onLogin() {
      this.$store.dispatch("login", {
          email: this.email,
          password: this.password,
        }).then((response) => {                   
         // this.$router.push("/home", () => {});
        })
        .catch((error) => {          
          console.log("Invalid Authentication");
        });
    },          
        }
    }

</script>

<style scoped>

</style>
