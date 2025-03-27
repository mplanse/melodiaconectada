<template>
    <div>
      <div id="map" style="width: 100%; height: 500px;"></div>
    </div>
  </template>

  <script>
  import mapboxgl from 'mapbox-gl';
  import axios from 'axios';
  import 'mapbox-gl/dist/mapbox-gl.css';

  export default {
    data() {
      return {
        map: null,
        musicos: []
      };
    },

    mounted() {
      // Configura el token de acceso de Mapbox
      mapboxgl.accessToken = 'pk.eyJ1Ijoiam9yZGl0dXMiLCJhIjoiY203d2VoMHgzMDNxcjJxc2Nqd2h3bTN0YyJ9.TcKwh0g8Wl9deYIYYVzK9w';

      // Inicializa el mapa
      this.map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [2.154007, 41.390205], // Barcelona
        zoom: 12
      });

      // Agregar controles de navegación
      this.map.addControl(new mapboxgl.NavigationControl());

      // Obtener datos de músicos desde Laravel
      this.obtenerMusicos();
    },

    methods: {
      async obtenerMusicos() {
        try {
          const response = await axios.get('obtener-coordenadas'); // Ajusta la URL según tu API
          this.musicos = response.data.musicos;
          this.agregarMarcadores();
        } catch (error) {
          console.error('Error al obtener datos de músicos:', error);
        }
      },

      agregarMarcadores() {
        this.musicos.forEach(musico => {
          new mapboxgl.Marker({ color: "blue" }) // Marcador azul
            .setLngLat([musico.long, musico.lat]) // Mapbox usa [longitud, latitud]
            .setPopup(new mapboxgl.Popup().setHTML(`<h3>${musico.descripcion}</h3>`)) // Popup con info
            .addTo(this.map);
        });
      }
    },

    beforeDestroy() {
      if (this.map) {
        this.map.remove();
      }
    }
  };
  </script>

  <style scoped>
  #map {
    width: 100%;
    height: 500px;
  }
  </style>
