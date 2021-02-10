<template>
  <div class="container">
    <div class="card">
      <div class="card-header">Register</div>
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
            <label>Name</label>
            <input
              type="text"
              class="form-control"
              placeholder="Name ..."
              v-model="name"
            />
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
          <div class="form-group">
            <label>Confirm password</label>
            <input
              type="password"
              class="form-control"
              placeholder="Confirm password ..."
              v-model="confirm"
            />
          </div>

          <button class="btn btn-success mb-2">Register</button>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "register",
  props: ["app"],
  data() {
    return {
      name: "",
      email: "",
      password: "",
      confirm: "",
      errors: [],
    };
  },
  methods: {
    onSubmit() {
      this.errors = [];
      if (!this.name) {
        this.errors.push("Name is required");
      }
      if (!this.email) {
        this.errors.push("Email is required");
      }
      if (!this.password) {
        this.errors.push("Password is required");
      }
      if (!this.confirm) {
        this.errors.push("Confirm your password");
      }
      if (this.password !== this.confirm) {
        this.errors.push("Passwords do not match");
      }

      if (!this.errors.length) {
        const formdata = {
          name: this.name,
          email: this.email,
          password: this.password,
        };

        axios
          .post("/auth/register", formdata)
          .then((res) => {
            this.app.user = res.data.user
            this.$router.push('/home')
          })
          .catch((error) => {
            this.errors.push(error.response.data.error)
          });
      }
    },
  },
};
</script>
<style >
</style>