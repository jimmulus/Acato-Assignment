
<template>
  <div>
    <v-overlay :value="overlay">
      <v-progress-circular indeterminate size="48"></v-progress-circular>
    </v-overlay>
    <navigation-menu></navigation-menu>

    <v-app-bar app clipped-left>
      <v-app-bar-nav-icon @click.stop="changeDrawer()" />
      <v-toolbar-title dark>
        <router-link :to="{ name: 'home'}">Broedvogels</router-link>
      </v-toolbar-title>
    </v-app-bar>

    <v-content>
      <v-container class="fill-height" fluid>
        <v-row align="center" justify="center">
          <v-col>
            <router-view></router-view>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </div>
</template>

<script>
import navigationMenu from "./components/Menu.vue";
export default {
  components: {
    navigationMenu
  },
  data() {
    return {
      overlay: false
    };
  },

  created() {
    // show loader
    EventBus.$on("overlay-open", () => {
      this.overlay = true;
    });

    // close loader
    EventBus.$on("overlay-close", () => {
      this.overlay = false;
    });

    // Dark theme
    this.$vuetify.theme.dark = true;
  },
  methods: {
    // navigation toggle
    changeDrawer() {
      EventBus.$emit("drawer-state");
    }
  }
};
</script>
<style scoped>
.v-application a {
  color: #fff;
  text-decoration: wavy;
}
</style>

