<template>
    <v-container fluid>
        <v-row
            align="center"
            justify="center"
        >
            <v-col>
                <v-card class="elevation-10">
                    <v-toolbar
                        white
                    >
                        <v-toolbar-title>Register</v-toolbar-title>

                    </v-toolbar>

                    <v-card-text  v-if="showErrors"> 
                        <v-btn
                            @click="showErrors = !showErrors">
                            Close
                        </v-btn>
                        <v-alert
                            :value="alert"
                            border="top"
                            transition="scale-transition" 
                            type="error"    
                        >
                            <p> {{errorMessage}} </p>
                             <li v-for="error in errors">
                                {{error}}
                            </li>
                        </v-alert>
                    </v-card-text>

                    <v-form @submit.prevent="register">
                        <v-card-text>
                            <v-row>

                                <v-col cols="12" sm="4" md="6">
                                    <v-text-field
                                        label="Nome"
                                        name="name"
                                        prepend-inner-icon="person"
                                        type="text"
                                        v-model="name"
                                    />
                                </v-col>

                                <v-col cols="12" sm="4" md="6">
                                    <v-text-field
                                        label="Email"
                                        name="email"
                                        prepend-inner-icon="mdi-email-outline"
                                        type="email"
                                        v-model="email"
                                    />
                                </v-col>
                            </v-row>

                            <v-row>
                                <v-col cols="12" sm="4" md="6">
                                    <v-text-field
                                        id="password"
                                        label="Password"
                                        name="password"
                                        prepend-inner-icon="lock"
                                        type="password"
                                        v-model="password"
                                    />
                                </v-col>
                            </v-row>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer/>
                            <v-btn type="submit"
                                   @click="register">Register
                            </v-btn>
                        </v-card-actions>
                    </v-form>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
export default {
    data: () => ({
        name: '',
        email: '',
        password: '',
        showErrors:false,
        errors:[],
        errorMessage:'',

    }),
    methods: {
        
        register() {
            axios.post('api/register',{
                name:this.name,
                password:this.password,
                email:this.email,
            })
             .then(response => {
                 this.showErrors = false;
                 //console.error(response)
             }).catch(error =>{
                 //console.error(error.response.data)
                 this.errorMessage=error.response.data.message;
                 this.errors = error.response.data.errors;
                 this.showErrors=true;
             });
        },
        reset() {
            this.$refs.form.reset()
        }
    }
}
</script>
