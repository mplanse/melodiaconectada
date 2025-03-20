<template>
    <div>
      <div id="map" style="width: 100%; height: 500px;"></div>
    </div>
  </template>

  <script>
  import mapboxgl from 'mapbox-gl';
  import 'mapbox-gl/dist/mapbox-gl.css';

  export default {
    name: "MapComponent",
    props: {
      usuario: {
        type: Array,
        required: true,
        default: () => [],
      },
    },
    data() {
      return {
        map: null,
      };
    },
    mounted() {
      this.initializeMap();
    },
    methods: {
      initializeMap() {
        mapboxgl.accessToken = 'pk.eyJ1Ijoiam9yZGl0dXMiLCJhIjoiY203d2VoMHgzMDNxcjJxc2Nqd2h3bTN0YyJ9.TcKwh0g8Wl9deYIYYVzK9w';

        this.map = new mapboxgl.Map({
          container: 'map',
          style: 'mapbox://styles/mapbox/streets-v12',
          center: [2.154007, 41.390205], // Centro inicial (Barcelona)
          zoom: 12,
        });

        // Espera a que el mapa esté cargado antes de agregar marcadores
        this.map.on('load', () => {
          this.addMarkers();
        });
      },
      addMarkers() {
        this.users.forEach(user => {
          if (user.lat && user.long) {
            new mapboxgl.Marker()
              .setLngLat([user.long, user.lat]) // Coordenadas del usuario
              .setPopup(new mapboxgl.Popup().setHTML(`<h3>${user.usuario.nombre}</h3><p>${user.descripcion}</p>`)) // Información del usuario
              .addTo(this.map);
          } else {
            console.warn(`Coordenadas inválidas para el usuario: ${user.usuario.nombre}`);
          }
        });
      },
    },
  };
  </script>

  <style scoped>
  #map {
    width: 100%;
    height: 500px;
  }
  </style>
