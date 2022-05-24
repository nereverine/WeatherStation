<template>
    <v-app>
        <v-app-bar
            app
            color="red"
            flat>

            <v-toolbar-title
                class="mr-10">WeatherStation@AnytimeAnywhere
            </v-toolbar-title>

            <v-btn
                v-for="item in menuItens"
                :key="item.title"
                :to="item.link"
                text
            >
                <v-icon dark>
                    {{ item.icon }}
                </v-icon>
                {{ item.title }}
            </v-btn>

            <v-spacer></v-spacer>



            <div class="mx-3"></div>

            <v-menu
                v-if="isUserAutenticaded"
                bottom
                min-width="200px"
                rounded
                offset-y
            >
                <template v-slot:activator="{ on }">
                    <v-btn
                        icon
                        x-large
                        v-on="on"
                    >
                        <v-avatar
                        >
                            <img :src="'storage/images/'+ user.name + '.png'"/>
                        </v-avatar>
                    </v-btn>
                </template>
                <v-card>
                    <v-list-item-content class="justify-center">
                        <div class="mx-auto text-center">
                            <v-avatar
                            >
                                <img :src="'storage/images/'+ user.name + '.png'"/>
                            </v-avatar>
                            <h4>{{ user.name }}</h4>
                            <p class="caption mt-1">
                                {{ user.email }}
                            </p>
                            <v-divider class="my-3"></v-divider>
                            <v-btn
                                depressed
                                rounded
                                text
                                to="/Profile"
                            >
                                Edit Account
                            </v-btn>
                            <v-divider class="my-3"></v-divider>
                            <v-btn  type="submit"
                                    @click="logout"
                                    active-class="active"

                                    depressed
                                    rounded
                                    text>Logout

                            </v-btn>
                        </div>
                    </v-list-item-content>
                </v-card>
            </v-menu>



        </v-app-bar>

        <v-main>
            <!-- Provides the application the proper gutter -->
            <v-container fluid>
                <!-- If using vue-router -->
                <router-view></router-view>
            </v-container>
        </v-main>
    </v-app>
</template>

<script>
import { cache } from 'browserslist';


export default {

    data: () => ({

    }),

    methods: {
        logout: function() {
            this.$store.dispatch("logout");
            this.$router.push({name:'Login'});
        }
    },
    computed: {
        isUserAutenticaded() {
            return this.$store.getters.authenticated
        },
        user() {
            if (this.isUserAutenticaded) {
                return this.$store.getters.user
            }
            return ''
        },
        menuItens() {
            let menuItens
            if (this.isUserAutenticaded) {
                //return this.$store.getters.links
                menuItens = [
                    {title: 'Home', icon: 'home', link: '/'},
                    {title: 'Stations', icon: 'mdi-web-box', link: '/Station'},
                    {title: 'Alerts', icon: 'mdi-alert-circle', link: '/Alert'},
                ]
            } else {
                menuItens = [
                    {title: 'Home', icon: 'home', link: '/'},
                    {title: 'Login', icon: 'login', link: '/Login'},
                    {title: 'Register', icon: 'face', link: '/Register'},
                ]
            }
            return menuItens
        },
    }
}
</script>
