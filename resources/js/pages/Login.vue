<template>
  <v-container>
    <v-card>
      <v-card-title>Login</v-card-title>
      <v-card-text>
        <v-alert type="error" v-if="has_error">
          <p>Fout, de login gegevens kloppen niet.</p>
        </v-alert>

        <v-form @submit.prevent="login">
          <v-text-field label="E-mail" v-model="email" type="email" required></v-text-field>
          <span class="red--text" v-if="errors.email">{{ errors.email[0] }}</span>
          <v-text-field label="Password" v-model="password" type="password" required></v-text-field>
          <span class="red--text" v-if="errors.password">{{ errors.password[0] }}</span>

          <v-card-actions>
            <v-btn class="green" dark type="submit">Login</v-btn>
            <v-btn light class="green lighten-2" to="/register">Registreer</v-btn>
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
      email: null,
      password: null,
      has_error: false,
      errors: {},
      error: {}
    };
  },
  mounted() {},
  methods: {
    login() {
      // get the redirect object
      var redirect = this.$auth.redirect();
      var app = this;
      this.$auth.login({
        params: {
          email: app.email,
          password: app.password
        },
        // on succes redirect
        success: function() {
          const redirectTo = redirect ? redirect.from.name : "dashboard";
          this.$router.push({ name: redirectTo });
        },
        // populate errors and error for display error messages
        error: function(res) {
          app.errors = res.response.data.errors || {};
          if (Object.keys(this.errors).length === 0) {
            app.has_error = true;
            app.error = res.response.data.error;
          }
        },
        // get user data
        fetchUser: true
      });
    }
  }
};
</script>
