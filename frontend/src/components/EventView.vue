<template>
  <v-container>
    <v-row class="text-center">
      <v-col cols="12">
        <h1 class="display-2 font-weight-bold mb-3 headline">
          EVENEMENTS
        </h1>
      </v-col>

      <v-col cols="12">
        <v-btn color="purple" dark @click="showForm = true" class="animated-btn">
          Créer un événement
        </v-btn>
      </v-col>
    </v-row>

    <v-row v-if="showForm" class="mt-5 fade-in justify-center">
      <v-col cols="12" md="8">
        <v-form ref="form" v-model="valid" @submit.prevent="submitForm" class="animated-form">
          <v-text-field
            v-model="title"
            label="Titre"
            :rules="[v => !!v || 'Titre requis']"
            required
            class="animated-input"
          ></v-text-field>
          <v-textarea
            v-model="description"
            label="Description"
            :rules="[v => !!v || 'Description requise']"
            required
            class="animated-input"
          ></v-textarea>
          <v-text-field
            v-model="address"
            label="Adresse"
            :rules="[v => !!v || 'Adresse requise']"
            required
            class="animated-input"
          ></v-text-field>

          <v-select
            v-model="city_id"
            :items="city"
            item-text="city_name"
            item-value="id"
            label="Sélectionner la ville"
            :rules="[v => !!v || 'Ville requise']"
            required
            class="animated-input"
          ></v-select>

          <v-text-field
            v-model="date_start"
            label="Date de début"
            type="datetime-local"
            :rules="[v => !!v || 'Date de début requise']"
            required
            class="animated-input"
          ></v-text-field>
          <v-text-field
            v-model="date_end"
            label="Date de fin"
            type="datetime-local"
            :rules="[v => !!v || 'Date de fin requise']"
            required
            class="animated-input"
          ></v-text-field>
          <v-file-input
            v-model="path_image"
            label="Image de l'événement"
            accept="image/*"
            :rules="[v => !!v || 'Image requise']"
            required
            outlined
            dense
            class="animated-input"
          ></v-file-input>
          <v-btn type="submit" :disabled="!valid" color="purple" dark class="animated-btn">Soumettre</v-btn>
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
      merchant_id: "", // Auto-filled merchant ID
      showForm: false,
      city: [], // List of cities
      valid: false
    };
  },
  created() {
    this.fetchCity();
    this.fetchMerchant();
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
        this.city = response.data;
      } catch (error) {
        console.error("Error fetching city:", error.message);
      }
    },

    // Fetch merchant data to auto-fill the merchant ID
    async fetchMerchant() {
      try {
        const token = localStorage.getItem('authToken');
        const response = await axios.get("http://127.0.0.1:8000/merchant/me", { // Adjust the endpoint if necessary
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });
        this.merchant_id = response.data.id; // Assuming the response contains the merchant ID
      } catch (error) {
        console.error("Error fetching merchant:", error.message);
      }
    },

    // Handle form submission
    async submitForm() {
      if (this.$refs.form.validate()) {
        const formData = new FormData();
        formData.append("title", this.title);
        formData.append("description", this.description);
        formData.append("address", this.address);
        formData.append("city_name", this.city_id);
        formData.append("date_start", new Date(this.date_start).toISOString());
        formData.append("date_end", new Date(this.date_end).toISOString());
        formData.append("merchant_id", this.merchant_id);

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
      this.showForm = false;
    },
  },
};
</script>

<style scoped>
.headline {
  animation: fadeInUp 0.5s ease-out;
}

.animated-form {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  background: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
  animation: fadeInUp 0.5s ease-out;
}

.animated-input {
  transition: all 0.3s ease-in-out;
  margin-bottom: 20px;
}

.animated-input:focus-within {
  box-shadow: 0 0 10px 2px rgba(103, 58, 183, 0.5); /* Purple glow */
  transform: scale(1.05);
}

.animated-btn {
  background-color: #673ab7; /* Purple color */
  transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
  margin-top: 20px;
}

.animated-btn:hover {
  background-color: #512da8; /* Darker purple on hover */
  transform: translateY(-2px);
}

.animated-btn:active {
  transform: translateY(0);
}

.fade-in {
  animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
