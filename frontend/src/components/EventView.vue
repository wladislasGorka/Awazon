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
            
            :items="city"
            item-title="city_name"
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
      shop_id: null,
      showForm: false,
      city: [],
      valid: false
    };
  },
  created() {
    this.fetchCity();
    this.fetchShop();
  },
  methods: {
    fetchCity() {
      fetch("http://127.0.0.1:8000/city", {
        method: 'GET',
      })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.json();
        })
        .then(data => {
          this.city = data;
          console.log("City data fetched:", data);
        })
        .catch(error => {
          console.error("Error fetching city:", error.message);
        });
    },

    fetchShop() {
  const shop = this.$cookies.get('shop');
  if (!shop || !shop.id) {
    console.error("Shop ID is not available.");
    return;
  }

  fetch(`http://127.0.0.1:8000/events/${shop.id}`, {
    method: 'GET',
    headers: {
      'Content-Type': 'application/json',
    },
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    this.shop_id = data.id;
  })
  .catch(error => {
    console.error("Error fetching shop:", error.message);
  });
},

    submitForm() {
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

        fetch("http://127.0.0.1:8000/events", {
          method: 'POST',
          body: formData
        })
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(data => {
            console.log("Event created successfully:", data);
            this.resetForm();
          })
          .catch(error => {
            console.error("Error creating event:", error.message);
          });
      }
    },

    resetForm() {
      this.title = "";
      this.description = "";
      this.address = "";
      this.city_id = null;
      this.city_name = "";
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
  background-color: #673ab7;
  transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
  margin-top: 20px;
}

.animated-btn:hover {
  background-color: #512da8; 
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
