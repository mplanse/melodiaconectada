<template>
    <div>
      <!-- Contenedor donde se renderizará el mapa -->
      <div id="map" style="width: 100%; height: 500px;"></div>
    </div>
  </template>

  <script>
  import mapboxgl from 'mapbox-gl'; // Importar Mapbox GL JS

  export default {
    name: "MapComponent",
    data() {
      return {
        map: null, // Variable para almacenar la instancia del mapa
      };
    },
    mounted() {
      // Configura el token de acceso de Mapbox
      mapboxgl.accessToken =
        "pk.eyJ1IjoiYXJuYXV2ZW50dXJhIiwiYSI6ImNsY3ltcGpoOTB1NzgzcHA3eTJndWgxOHoifQ.H3tOjoRnBA_csnH1Qk5UQw";

      // Inicializa el mapa
      this.map = new mapboxgl.Map({
        container: "map", // ID del contenedor
        style: "mapbox://styles/mapbox/streets-v12", // Estilo del mapa
        center: [-74.5, 40], // Coordenadas iniciales [lng, lat]
        zoom: 9, // Nivel de zoom inicial
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
    height: 500px;
  }
  </style>
