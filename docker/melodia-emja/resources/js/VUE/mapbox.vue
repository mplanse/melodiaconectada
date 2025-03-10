<template>
    <div>
      <div id="map" style="width: 100%; height: 500px;"></div>
    </div>
  </template>

  <script>
  import mapboxgl from 'mapbox-gl';
  import 'mapbox-gl/dist/mapbox-gl.css';
  import axios from 'axios';

  export default {
    name: "MapComponent",
    data() {
      return {
        map: null,
        musicos: [],
        restaurantes: []
      };
    },
    mounted() {
      // Configura el token de acceso de Mapbox
      mapboxgl.accessToken = 'TU_ACCESS_TOKEN_DE_MAPBOX';

      // Inicializa el mapa
      this.map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12',
        center: [2.154007, 41.390205], // Barcelona
        zoom: 12
      });

      this.map.addControl(new mapboxgl.NavigationControl());

      // Obtener datos desde Laravel
      axios.get('/api/obtener-coordenadas')
        .then(response => {
          this.musicos = response.data.musicos;
          this.restaurantes = response.data.restaurantes;

          this.agregarMusicos();
          this.geocodificarRestaurantes();
        })
        .catch(error => console.error("Error al obtener datos:", error));
    },
    methods: {
      // 🔹 1. Agregar marcadores para músicos (usan lat, long directamente)
      agregarMusicos() {
        this.musicos.forEach(musico => {
          let coordenadas = [musico.long, musico.lat];
          this.agregarMarcador(coordenadas, musico.descripcion, "blue"); // Color azul para músicos
        });
      },

      // 🔹 2. Convertir direcciones de restaurantes en coordenadas
      async geocodificarRestaurantes() {
        for (let restaurante of this.restaurantes) {
          let direccion = restaurante.direccion;
          let url = `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(direccion)}.json?access_token=${mapboxgl.accessToken}`;

          try {
            let response = await axios.get(url);
            let coordenadas = response.data.features[0]?.geometry?.coordinates;

            if (coordenadas) {
              this.agregarMarcador(coordenadas, direccion, "red"); // Color rojo para restaurantes
            } else {
              console.warn(`No se encontraron coordenadas para: ${direccion}`);
            }
          } catch (error) {
            console.error(`Error geocodificando ${direccion}:`, error);
          }
        }
      },

      // 🔹 3. Agregar un marcador en el mapa con color y popup
      agregarMarcador(coordenadas, texto, color) {
        let marker = new mapboxgl.Marker({ color })
          .setLngLat(coordenadas)
          .setPopup(new mapboxgl.Popup().setText(texto))
          .addTo(this.map);
      }
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
