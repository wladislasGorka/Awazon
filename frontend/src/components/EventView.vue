<template>
  <v-container>
    <v-row class="text-center">
      <v-col cols="12">
        <h1 class="display-2 font-weight-bold mb-3">
          EVENEMENTS
        </h1>
      </v-col>

      <v-col cols="12">
        <v-btn color="primary" @click="showForm = true">
          Créer un événement
        </v-btn>
      </v-col>
    </v-row>

    <v-row v-if="showForm" class="mt-5">
      <v-col cols="12">
        <v-form @submit.prevent="submitForm">
          <v-text-field v-model="title" label="Title" required></v-text-field>
          <v-textarea v-model="description" label="Description" required></v-textarea>
          <v-text-field v-model="address" label="Address" required></v-text-field>

          <v-select 
            v-model="city_id"
            :items="city"
            item-text="city_name" 
            item-value="id" 
            label="Select City"
            required
          ></v-select>

          <v-text-field v-model="date_start" label="Start Date" type="datetime-local" required></v-text-field>
          <v-text-field v-model="date_end" label="End Date" type="datetime-local" required></v-text-field>
          <v-file-input 
            v-model="path_image" 
            label="Event Image" 
            accept="image/*" 
            required 
            outlined
            dense
          ></v-file-input>
          <v-text-field v-model="shop_id" label="Shop ID" required></v-text-field>
          <v-btn type="submit" color="primary">Submit</v-btn>
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  name: "EventsPage",
  data() {
    return {
      title: "",
      description: "",
      address: "",
      city_id: null,
      date_start: "",
      date_end: "",
      path_image: null,
      shop_id: "",
      showForm: false,
      city: [], // List of cities
    };
  },
  created() {
    this.fetchCity();
  },
  methods: {
    // Fetch city data from the backend
    async fetchCity() {
      try {
        const token = localStorage.getItem('authToken');
        const response = await axios.get("http://127.0.0.1:8000/city", {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });
        this.city = response.data; // ✅ FIXED: Correct way to access response data in Axios
      } catch (error) {
        console.error("Error fetching city:", error.message);
      }
    },

    // Handle form submission
    async submitForm() {
      const formData = new FormData();
      formData.append("title", this.title);
      formData.append("description", this.description);
      formData.append("address", this.address);
      formData.append("city_name", this.city_id);
      formData.append("date_start", new Date(this.date_start).toISOString());
      formData.append("date_end", new Date(this.date_end).toISOString());
      formData.append("shop_id", this.shop_id);

      if (this.path_image) {
        formData.append("path_image", this.path_image);
      }

      try {
        const token = localStorage.getItem('authToken');
        const response = await axios.post("http://127.0.0.1:8000/events", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
            'Authorization': `Bearer ${token}`
          },
        });
        console.log("Event created successfully:", response.data);
        this.resetForm();
      } catch (error) {
        console.error("Error creating event:", error.response ? error.response.data : error.message);
      }
    },

    // Reset form fields after submission
    resetForm() {
      this.title = "";
      this.description = "";
      this.address = "";
      this.city_id = null;
      this.date_start = "";
      this.date_end = "";
      this.path_image = null;
      this.shop_id = "";
      this.showForm = false;
    },
  },
};
</script>
