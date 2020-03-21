<template>
  <div>
    <modal></modal>
    <v-card>
      <v-card-title>
        {{title}}
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="mdi-magnify"
          label="Zoeken"
          single-line
          hide-details
        ></v-text-field>
      </v-card-title>
      <v-data-table :headers="cols" :items="items" :search="search">
        <template v-slot:item.ID="{ item }">
          <v-btn icon color="green">
            <v-icon dark @click="modalPopup(item)">mdi-email</v-icon>
          </v-btn>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>

<script>
import modal from "./Modal";
export default {
  components: { modal },
  props: ["cols", "items", "title"],
  data() {
    return {
      search: ""
    };
  },
  methods: {
    // display modal for sending email
    modalPopup(item) {
      EventBus.$emit("modal-open", item);
    }
  }
};
</script>

<style>
</style>
