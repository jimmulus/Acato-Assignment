<template>
  <v-container>
    <v-card>
      <v-card-title>Registreer</v-card-title>
      <v-card-text>
        <v-form @submit.prevent="register" v-if="!success" method="post">
          <v-text-field label="Naam" v-model="name" type="text" required></v-text-field>
          <span class="red--text" v-if="errors.name">{{ errors.name[0] }}</span>
          <v-text-field label="E-mail" v-model="email" type="email" required></v-text-field>
          <span class="red--text" v-if="errors.email">{{ errors.email[0] }}</span>
          <v-text-field label="Wachtwoord" v-model="password" type="password" required></v-text-field>
          <span class="red--text" v-if="errors.email">{{ errors.password[0] }}</span>
          <v-text-field
            label="Wachtwoord herhalen"
            v-model="password_confirmation"
            type="password"
            required
          ></v-text-field>
          <v-card-actions>
            <v-btn class="green" dark type="submit">Registreer</v-btn>
          </v-card-actions>
        </v-form>
      </v-card-text>
    </v-card>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
      name: null,
      email: null,
      password: null,
      password_confirmation: null,
      has_error: false,
      error: null,
      errors: {},
      success: false
    };
  },
  methods: {
    register() {
      var app = this;
      // post new user data
      this.$auth.register({
        data: {
          name: app.name,
          email: app.email,
          password: app.password,
          password_confirmation: app.password_confirmation
        },
        // on succes redirect to login page
        success: function() {
          app.success = true;
          this.$router.push({
            name: "login",
            params: { successRegistrationRedirect: true }
          });
        },
        // populate errors for display error messages
        error: function(res) {
          app.errors = res.response.data.errors || {};
        }
      });
    }
  }
};
</script>
