<template>
    <div>
      <div id="map"></div>
    </div>
  </template>

  <script>
  import mapboxgl from 'mapbox-gl';
  import 'mapbox-gl/dist/mapbox-gl.css';

  export default {
    name: "MapComponent",
    data() {
      return {
        map: null,
      };
    },
    async mounted() {
      // Configurar el token de acceso de Mapbox
      mapboxgl.accessToken = 'pk.eyJ1Ijoiam9yZGl0dXMiLCJhIjoiY203d2VoMHgzMDNxcjJxc2Nqd2h3bTN0YyJ9.TcKwh0g8Wl9deYIYYVzK9w';

      // Inicializar el mapa
      this.map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [2.154007, 41.390205],  // Barcelona [lng, lat]
        zoom: 12,
      });

      // Agregar controles de zoom
      this.map.addControl(new mapboxgl.NavigationControl());

      // Obtener datos desde la API
      await this.fetchLocations();
    },
    methods: {
      async fetchLocations() {
        try {
          const response = await fetch('/api/obtener-coordenadas'); // Llamada a tu API
          const data = await response.json();

          // Agregar marcadores para músicos
          data.musicos.forEach(musico => {
            new mapboxgl.Marker({ color: "blue" }) // Azul para músicos
              .setLngLat([musico.long, musico.lat]) // [lng, lat]
              .setPopup(new mapboxgl.Popup().setText(musico.descripcion))
              .addTo(this.map);
          });

          // Agregar marcadores para restaurantes
          data.restaurantes.forEach(restaurante => {
            new mapboxgl.Marker({ color: "red" }) // Rojo para restaurantes
              .setLngLat([restaurante.long, restaurante.lat]) // [lng, lat]
              .setPopup(new mapboxgl.Popup().setText(restaurante.direccion))
              .addTo(this.map);
          });

        } catch (error) {
          console.error("Error al obtener coordenadas:", error);
        }
      },
    },
    beforeDestroy() {
      if (this.map) {
        this.map.remove();
      }
    },
  };
  </script>

  <style scoped>
  #map {
    width: 100%;
    height: 500px;
  }
  </style>
