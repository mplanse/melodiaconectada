<template>
    <div>
      <!-- Contenedor donde se renderizará el mapa -->
      <div id="map" style="width: 100%; height: 500px;"></div>
    </div>
  </template>

  <script>
  import mapboxgl from 'mapbox-gl'; // Importar Mapbox GL JS
  import 'mapbox-gl/dist/mapbox-gl.css'; // Asegurar que el estilo se carga

  export default {
    name: "MapComponent",
    data() {
      return {
        map: null, // Variable para almacenar la instancia del mapa
      };
    },
    mounted() {
      // Configura el token de acceso de Mapbox
      mapboxgl.accessToken = 'pk.eyJ1Ijoiam9yZGl0dXMiLCJhIjoiY203d2VoMHgzMDNxcjJxc2Nqd2h3bTN0YyJ9.TcKwh0g8Wl9deYIYYVzK9w';

      // Inicializa el mapa
      this.map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v12',
  center: [2.154007, 41.390205],  // Barcelona [lng, lat]
  zoom: 12,  // Nivel de zoom adecuado
});


      // Opcional: Agregar control de navegación (zoom in/out)
      this.map.addControl(new mapboxgl.NavigationControl());
    },
    beforeDestroy() {
      // Limpiar el mapa antes de destruir el componente
      if (this.map) {
        this.map.remove();
      }
    },
  };
  </script>

  <style scoped>
  /* Estilos opcionales para el mapa */
  #map {
    width: 100%;
    height: 500px; /* Asegúrate de que el contenedor tenga una altura definida */
  }
  </style>
