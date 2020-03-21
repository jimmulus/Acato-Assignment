<template>
  <v-navigation-drawer v-model="drawer" app clipped>
    <v-list dense>
      <span v-if="!$auth.check()">
        <v-list-item
          link
          v-for="(route) in routes.unlogged"
          :key="route.path"
          :to="{ name : route.path }"
        >
          <v-list-item-action>
            <v-icon>{{route.icon}}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{route.name}}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </span>
      <span v-if="$auth.check()">
        <v-list-item
          link
          v-for="(route) in routes.user"
          :key="route.path"
          :to="{ name : route.path }"
        >
          <v-list-item-action>
            <v-icon>{{route.icon}}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>{{route.name}}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <v-list-item link @click.prevent="$auth.logout()">
          <v-list-item-action>
            <v-icon>mdi-cancel</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title>Logout</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </span>
    </v-list>
  </v-navigation-drawer>
</template>
<script>
export default {
  data() {
    return {
      drawer: null,
      routes: {
        // Not logged in routes
        unlogged: [
          {
            name: "Maak een account aan",
            path: "register",
            icon: "mdi-plus-box"
          },
          {
            name: "Log in",
            path: "login",
            icon: "mdi-lock-open"
          }
        ],
        // loged in  routes
        user: [
          {
            name: "Dashboard",
            path: "dashboard",
            icon: "mdi-view-dashboard"
          }
        ]
      }
    };
  },
  created() {
    // invert navagation toggle
    EventBus.$on("drawer-state", item => {
      this.drawer = !this.drawer;
    });
  }
};
</script>
