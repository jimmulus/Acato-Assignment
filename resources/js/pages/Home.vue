<template>
  <v-card class="mx-auto" max-width="800">
    <v-img
      class="white--text align-end"
      height="200px"
      src="https://www.greatbirdpics.com/wp-content/uploads/2020/05/Tennessee-Warbler.jpg"
    >
      <v-card-title dark>{{ info.ShortTitle }}</v-card-title>
    </v-img>
    <v-card-actions>
      <v-btn
        small
        class="green mx-2 mt-2"
        v-if="!$auth.check()"
        to="/register"
      >Registreer en rapporteer</v-btn>
    </v-card-actions>
    <v-card-text class="text--primary">
      <div v-html="info.ShortDescription"></div>
    </v-card-text>
  </v-card>
</template>

<script>
import birdServices from "../services/birdServices.js";
export default {
  data() {
    return {
      info: {}
    };
  },
  created() {
    // open loader
    this.overlayOpen(),
      // get report information
      birdServices
        .getInfo()
        .then(response => {
          this.info = response.data;
        })
        // close loader
        .then(() => {
          this.overlayClose();
        })
        // populate errors for display error messages
        .catch(error => {
          (this.errors = "There was an error:"), error.response;
        });
  },
  methods: {
    // open loader
    overlayOpen() {
      EventBus.$emit("overlay-open");
    },
    //close loader
    overlayClose() {
      EventBus.$emit("overlay-close");
    }
  }
};
</script>

<style>
</style>
