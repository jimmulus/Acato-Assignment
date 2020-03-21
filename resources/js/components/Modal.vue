<template>
  <v-row justify="center">
    <v-snackbar v-model="snackbar" :timeout="3000">
      Rapport is succesvol verstuurd!
      <v-btn color="green" text @click="snackbar = false">Sluiten</v-btn>
    </v-snackbar>
    <v-dialog v-model="dialog" persistent max-width="600px">
      <v-card>
        <v-card-title>
          <h2 class="headline">Stuur rapport over de {{form.item.Broedvogels}}</h2>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12">
                <v-text-field label="E-mail *" required v-model="form.email"></v-text-field>
                <span class="red--text" v-if="errors.email">{{ errors.email[0] }}</span>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red darken-1" text @click="dialog = false">Annuleer</v-btn>
          <v-btn color="green darken-1" text @click="sendMail">Stuur rapport</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
import birdServices from "../services/birdServices.js";
export default {
  data() {
    return {
      snackbar: false,
      dialog: false,
      item: {},
      form: {
        user: this.$auth.user().name,
        email: null,
        item: {}
      },
      errors: {}
    };
  },
  created() {
    // on event open modal
    EventBus.$on("modal-open", item => {
      this.dialog = true;
      this.form.item = item;
    });
  },
  methods: {
    sendMail() {
      // Send email and reset data
      birdServices
        .sendReport(this.form)
        .then(response => {
          this.dialog = false;
          this.form.item = {};
          this.form.email = null;
          this.snackbar = true;
          this.errors = {};
        })
        .catch(error => (this.errors = error.response.data.errors));
    }
  }
};
</script>
