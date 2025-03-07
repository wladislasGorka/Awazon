<template>
  <div class="mapouter">
    <div class="gmap_canvas">
      <div
        id="map"
        width="820"
        height="560"
        style="overflow: hidden; background: none !important;"
      ></div>
      <a href="https://online.stopwatch-timer.net/">timer stopwatch</a><br />
      <a href="https://textcaseconvert.com/"></a><br />
      <a href="https://www.embedmaps.co">google maps embed</a>
    </div>
  </div>
</template>

<script>
import L from "leaflet";

export default {
  name: "MapComponent",
  data() {
    return {
      map: null,
    };
  },
  mounted() {
    this.$nextTick(() => {
      this.initMap();
    });
  },
  methods: {
    async initMap() {
      try {
        // Initialisation de la carte avec les coordonnées de Béziers
        this.map = L.map("map").setView([43.3442, 3.2158], 13);

        // Ajouter les tuiles (OpenStreetMap)
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
          attribution:
            '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(this.map);
      } catch (error) {
        console.error("Erreur lors de l'initialisation de la carte :", error);
      }
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
#map {
  height: 400px;
  width: 100%;
}
</style>
