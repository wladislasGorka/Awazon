<template>
  <v-container>
    <v-row class="text-center">
      <v-col cols="12">
        <h1 class="display-2 font-weight-bold mb-3 headline">EVENEMENTS</h1>
      </v-col>

      <v-col cols="12">
        <v-btn color="purple" dark @click="showForm = true" class="animated-btn" v-if="isLoggedIn && this.$cookies.get('user').roles[1]==='ROLE_MERCHANT'">
          Créer un événement
        </v-btn>
      </v-col>

      <v-col cols="12" class="mt-5">
       
        <v-btn @click="fetchEvents()" color="purple" dark>
          Afficher les plus récents
        </v-btn>
      </v-col>

     
      <v-col cols="12" class="mt-5">
        <v-row>
          <v-col v-for="(event, index) in events" :key="index" cols="12" sm="6" md="4">
           
            <v-card class="pa-0" :style="`background-image: url(${event.path_image}); background-size: cover; background-position: center;`">
              <v-img
                src=""
                alt="Event Image"
                class="event-image-overlay"
                :style="{ backgroundImage: `url(${event.path_image})`, backgroundSize: 'cover', backgroundPosition: 'center' }"
              >
                <v-card-title class="event-title">
                  <span>{{ event.title }}</span>
                </v-card-title>
                <v-card-actions class="pa-0">
                  <v-btn color="purple" dark @click="attendEvent(event)">Participer</v-btn>
                </v-card-actions>
                <v-card-text>
                  <span>{{ event.description }}</span>
                  <br>
                  <span>Date début: {{ event.date_start }}</span>
                  <br>
                  <span>Date Fin: {{ event.date_start }}</span>
                  <br>
                  <span>Adresse: {{ event.address }}</span>
                </v-card-text>
              </v-img>
            </v-card>
          </v-col>
        </v-row>
        <v-alert v-if="events.length === 0" type="info" class="mt-5">
          Aucun événement trouvé.
        </v-alert>
      </v-col>

      
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
              v-model= "city_id"
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
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters } from 'vuex';

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
      path_image: "",
      shop_id: null,
      showForm: false,
      city: [],
      valid: false,
      events: [], 
      sortedEvents: [],
      merchantId: null,
    };
  },
  computed: {
      ...mapGetters(['isLoggedIn']),
  },
  created() {
    this.fetchCity();
    this.fetchEvents(); 
  },
  methods: {
    fetchCity() {
      fetch("http://127.0.0.1:8000/city", {
        method: 'GET',
      })
        .then(response => response.json())
        .then(data => {
          this.city = data;
        })
        .catch(error => console.error("Error fetching city:", error));
    },

    fetchEvents() {
      fetch("http://127.0.0.1:8000/events", {
        method: 'GET',
      })
        .then(response => response.json())
        .then(data => {
          this.events = data;
          //this.sortEvents();
        })
        .catch(error => console.error("Error fetching events:", error));
    },

    sortEvents() {
      // Sort events by most recent
      this.sortedEvents = this.events.sort((a, b) => new Date(b.date_start) - new Date(a.date_start));
    },

    attendEvent(event) {
      // Implement logic to attend an event
      console.log("User attending event:", event);
     
    },

    submitForm() {
    
      const eventData = {
        title: this.title,
        description: this.description,
        address: this.address,
        city_name: this.city_id,
        date_start: this.date_start,
        date_end: this.date_end,
        path_image: this.path_image,
        merchantId: this.$cookies.get('user').id
      }
      fetch("http://127.0.0.1:8000/events", {
        method: 'POST',
        body: JSON.stringify(eventData)
      })
        .then(response => response.json())
        .then(data => {
          console.log("Event created successfully:", data);
          this.fetchEvents(); // Refresh events after creation
          this.resetForm(); // Reset form after submission
        })
        .catch(error => console.error("Error creating event:", error));
    },

    resetForm() {
      // Reset form fields
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

.event-image-overlay {
  position: relative;
  height: 100%;
  opacity: 0.6;
}

.event-title {
  position: absolute;
  top: 10px;
  left: 0;
  right: 0;
  padding: 10px;
  background-color: rgba(0, 0, 0, 0.5);
  color: white;
  font-size: 20px;
  text-align: center;
  z-index: 1;
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


@media (prefers-color-scheme: dark) {
  :root {
    --form-bg-color: #333;
    --form-text-color: #fff;
  }
}


@media (prefers-color-scheme: light) {
  :root {
    --form-bg-color: #fff;
    --form-text-color: #000;
  }
}
</style>
