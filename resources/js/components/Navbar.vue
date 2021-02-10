<template>
  <div class=" mb-4">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container-fluid">
        <router-link to="/" class="navbar-brand">Laravel Test</router-link>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto">
              <a
                class="nav-link"
                role="button"
                aria-haspopup="true"
                aria-expanded="false"
              >
                {{ app.user ? app.user.name : "" }}
              </a>
                <div v-if="!app.user" class="row">
                  <router-link to="/login" class="nav-link"
                    >Login</router-link
                  >
                  <router-link to="/register" class="nav-link"
                    >Register</router-link
                  >
                </div>
                <a
                  v-else
                  @click="logout"
                  class="nav-link"
                  href="javascript:;"
                  >Logout</a>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>
<script>
export default {
  name: "navbar",
  props: ["app"],
  data() {
    return {};
  },
  methods: {
    logout() {
      this.app.req.get("/auth/logout").then(() => {
        this.app.user = null;
        this.$router.push("/login");
      });
    },
  },
};
</script>
<style lang="">
</style>