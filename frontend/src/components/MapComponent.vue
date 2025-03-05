<template>
  <div class="mapouter">
    <div class="gmap_canvas">
      <iframe
        width="820"
        height="560"
        id="gmap_canvas"
        src="https://maps.google.com/maps?q=3+place+du+14+juillet+34500+B%C3%A9ziers+France&t=&z=13&ie=UTF8&iwloc=&output=embed"
        frameborder="0"
        scrolling="no"
        marginheight="0"
        marginwidth="0">
      </iframe>
    </div>
  </div>
</template>

<script>

import L from 'leaflet'; // Importez Leaflet

export default {
  name: "MapComponent",
  data() {
    return {
      map: null,
    };
  },
  mounted() {
    this.initMap();
  },
  methods: {
    async initMap() {
      // Initialisation de la carte
      this.map = L.map("map").setView([48.8566, 2.3522], 13); // Coordonnées par défaut (Paris)

      // Ajouter les tuiles (OpenStreetMap)
      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
      }).addTo(this.map);

      // Charger les données des magasins
      const response = await fetch("http://localhost:8000/api/shops");
      const shops = await response.json();

      // Ajouter des marqueurs pour chaque magasin
      shops.forEach((shop) => {
        L.marker([shop.latitude, shop.longitude])
          .addTo(this.map)
          .bindPopup(`<b>${shop.name}</b><br>${shop.address}`);
      });
    },
  },
};
</script>

<style scoped>
.mapouter {
  position: relative;
  text-align: right;
  height: 560px;
  width: 820px;
}

.gmap_canvas {
  overflow: hidden;
  background: none !important;
  height: 560px;
  width: 820px;
}
</style>
