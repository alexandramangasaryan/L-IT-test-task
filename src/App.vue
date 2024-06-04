<template>
  <div id="app">
    <div class="d-flex justify-content-center align-items-center mb-4">
      <div class="form-group me-2">
        <label>Min Age: </label>
        <input class="form-control" type="number" v-model="ageMin" />
      </div>
      <div class="form-group me-2">
        <label>Max Age: </label>
        <input class="form-control" type="number" v-model="ageMax" />
      </div>
      <div class="form-group me-2">
        <label>Search: </label>
        <input class="form-control" type="text" v-model="search" />
      </div>
    </div>
    <div class="mb-3">
      <button class="btn btn-success w-25" @click="getUsers">Filter</button>
    </div>

    <h1>User List</h1>
    <table>
      <thead>
      <tr>
        <th>Name</th>
        <th>Age</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="user in users" :key="user.id">
        <td>{{ user.name }}</td>
        <td>{{ user.age }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: [],
      ageMin: 0,
      ageMax: 100,
      search: ''
    };
  },
  methods: {
    getUsers() {
      axios.get(`http://localhost:8000?age_min=${this.ageMin}&age_max=${this.ageMax}&search=${this.search}`)
          .then(response => {
            this.users = response.data;
          })
          .catch(error => {
            console.error("There was an error!", error);
          });
    }
  },
  created() {
    this.getUsers();
  }
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  margin-top: 60px;
}
table {
  width: 100%;
  border-collapse: collapse;
}
th, td {
  border: 1px solid #ddd;
  padding: 8px;
}
th {
  background-color: #f2f2f2;
}
</style>
