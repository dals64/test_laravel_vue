<template >
  <div class="container">
    <div class="card">
      <div class="card-header">Login</div>
      <div class="card-body offset-2 col-6">
        <form v-on:submit.prevent="onSubmit">
          <div class="alert alert-danger" v-if="errors.length">
            <ul class="mb-0">
              <li v-for="(error, index) in errors" :key="index">
                {{ error }}
              </li>
            </ul>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input
              type="email"
              class="form-control"
              placeholder="Username ..."
              v-model="email"
            />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input
              type="password"
              class="form-control"
              placeholder="Password ..."
              v-model="password"
            />
          </div>

          <button type="submit" class="btn btn-success mb-2">Login</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import axios from 'axios';
export default {
  name: "login",
  props: ["app"],
  data() {
    return {
      email: "",
      password: "",
      errors: [],
    };
  },
  methods: {
    onSubmit() {
      this.errors = [];
      if (!this.email) {
        this.errors.push("Email is required");
      }
      if (!this.password) {
        this.errors.push("Password is required");
      }

      if (!this.errors.length) {
        const data = {
          email: this.email,
          password: this.password,
        };

        axios.post("auth/login", data)
          .then((response) => {
            this.app.user = response.data.user;
            this.$router.push("/home");
          })
          .catch((error) => {
            this.errors.push(error.response.data.error);
          });
      }
    },
  },
};
</script>
<style lang="">
</style>