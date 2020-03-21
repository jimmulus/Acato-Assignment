<template>
  <v-container>
    <v-card class="mx-auto" outlined>
      <v-list-item three-line>
        <v-list-item-content>
          <v-list-item-title class="headline mb-1">Persoonlijke Dashboard {{ $auth.user().name }}</v-list-item-title>
          <v-list-item-subtitle>Stuur snel rapporten door op een van de e-mail knoppen te klikken.</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-avatar tile size="80" color="grey darken-2">
          <img
            src="https://cdn2.iconfinder.com/data/icons/spring-glyph-black/2048/5662_-_Nest-512.png"
            alt="Nest"
          />
        </v-list-item-avatar>
      </v-list-item>
    </v-card>
    <data-table :items="value" :cols="headers" title="Broedvogels"></data-table>
  </v-container>
</template>

<script>
import birdServices from "../../services/birdServices.js";
import dataTable from "../../components/DataTable";
export default {
  data() {
    return {
      value: [],
      headers: []
    };
  },
  components: { dataTable },
  created() {
    this.overlayOpen(),
      // Get data
      birdServices
        .getBirds()
        .then(response => {
          this.value = response.data.value;
          this.makeHeaders(response.data.properties);
        })
        .then(() => {
          this.overlayClose();
        })
        .catch(error => {
          (this.errors = "There was an error:"), error.response;
        });
  },

  methods: {
    // Create Headers for datatable
    makeHeaders: function(data) {
      this.headers.push({ text: "", value: "ID" });
      data.forEach(item =>
        this.headers.push({ text: item.Title, value: item.Key })
      );
    },
    // open loader
    overlayOpen() {
      EventBus.$emit("overlay-open");
    },
    // close loader
    overlayClose() {
      EventBus.$emit("overlay-close");
    }
  }
};
</script>
