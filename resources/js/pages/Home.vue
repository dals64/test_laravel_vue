<template >
  <div class="container-fluid">
    <div class="mt-4 col-6 offset-3">
      <div class="card" id="form">
        <form
          class="text-center border border-light p-5"
          v-on:submit.prevent="onSubmit"
        >
          <p class="h3 mb-4" title="title">Add a product</p>
          <div class="alert alert-danger" v-if="errors.length">
            <ul class="mb-0">
              <li v-for="(error, index) in errors" :key="index">
                {{ error }}
              </li>
            </ul>
          </div>
          <div class="form-row mb-4">
            <div class="col">
              <input
                type="text"
                class="form-control"
                placeholder="Product name..."
                v-model="name"
              />
            </div>
          </div>

          <!-- submit button -->
          <button class="btn btn-success">Ajouter</button>
        </form>
      </div>
    </div>

    <div class="container-fluid">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in products" :key="product.id">
            <th scope="row">{{ product.id }}</th>
            <td>{{ product.name }}</td>
            <td>
              <span
                class="alert alert-success"
                data-toggle="modal"
                data-target="#exampleModalCenter"
                @click="setVal(product.id, product.name)"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-pencil-square"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"
                  />
                  <path
                    fill-rule="evenodd"
                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"
                  />
                </svg>
              </span>

              <span class="alert alert-danger" @click="deleteProduct(product.id)">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="16"
                  height="16"
                  fill="currentColor"
                  class="bi bi-trash"
                  viewBox="0 0 16 16"
                >
                  <path
                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"
                  />
                  <path
                    fill-rule="evenodd"
                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"
                  />
                </svg>
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModalCenter"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Edit product</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form
              class="text-center border border-light p-5"
              v-on:submit.prevent="editProduct"
            >
              <div class="alert alert-danger" v-if="errors.length">
                <ul class="mb-0">
                  <li v-for="(error, index) in errors" :key="index">
                    {{ error }}
                  </li>
                </ul>
              </div>
              <div class="form-row mb-4">
                <div class="col">
                  <input
                    type="text"
                    class="form-control"
                    placeholder="Product name..."
                    v-model="name"
                    value="name"
                  />
                </div>
              </div>
              <div class="form-row mb-4">
                <button
                  type="button"
                  class="btn btn-secondary col"
                  data-dismiss="modal"
                  @click="
                    name = '';
                    id = '';
                  "
                  style="margin:5px"
                >
                  Close
                </button>
                <button type="submit" class="btn btn-primary col" style="margin:5px">
                  Save changes
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "home",
  props: ["app"],
  data() {
    return {
      id: "",
      name: "",
      errors: [],
      products: [],
      showModal: false,
    };
  },

  mounted: function mounted() {
    this.getProducts();
  },

  methods: {
    onSubmit: function onSubmit() {
      this.errors = [];
      if (!this.name) {
        this.errors.push("Name is required");
      }
      if (!this.errors.length) {
        axios
          .post("/product/store", { name: this.name })
          .then((res) => {
            alert(res.data.message);
            this.getProducts();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },

    getProducts: function getProducts() {
      axios
        .get("/product")
        .then((res) => {
          this.products = res.data.products;
          console.log(this.products);
        })
        .catch((error) => {
          console.log(error);
        });
    },

    setVal: function setVal(id, name) {
      this.id = id;
      this.name = name;
    },

    editProduct: function editProduct() {
        axios
        .post("/product/update", {name:this.name, id: this.id})
        .then((res) => {
          alert(res.data.message)
          this.getProducts()
          this.name=''
          this.id=''
        })
        .catch((error) => {
          console.log(error);
        });
    },

    deleteProduct: function deleteProduct(id) {
        axios
        .post("/product/delete", {id: id})
        .then((res) => {
          this.getProducts()
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style >
#form {
  margin-bottom: 50px;
}

span {
  margin: 5px;
}

</style>