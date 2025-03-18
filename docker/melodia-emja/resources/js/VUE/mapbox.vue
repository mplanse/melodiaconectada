<template>
    <div>
      <div id="map" style="width: 100%; height: 500px;"></div>
    </div>
  </template>

  <script>
  import mapboxgl from 'mapbox-gl';
  import 'mapbox-gl/dist/mapbox-gl.css';
  import axios from 'axios'; // Usaremos Axios para hacer la solicitud HTTP

  export default {
    name: "MapComponent",
    data() {
      return {
        map: null,
        musicos: [], // Aquí almacenaremos las coordenadas de los músicos
        marker: null, // Marcador actual
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

      // Agregar control de navegación (zoom in/out)
      this.map.addControl(new mapboxgl.NavigationControl());

      // Llamada a la API para obtener los músicos
      axios.get('/api/musicos-coordenadas')
        .then(response => {
          this.musicos = response.data.musicos;
          this.addMarkers(); // Agregar los marcadores en el mapa
        })
        .catch(error => {
          console.error("Hubo un error al obtener las coordenadas de los músicos:", error);
        });

      // Evento de clic en el mapa para agregar marcadores
      this.map.on('click', (e) => {
        this.addMarker(e.lngLat);
        this.saveMarker(e.lngLat);
      });
    },
    methods: {
      addMarkers() {
        this.musicos.forEach(musico => {
          // Crear un marcador para cada músico
          new mapboxgl.Marker()
            .setLngLat([musico.long, musico.lat]) // Longitud, latitud
            .setPopup(new mapboxgl.Popup().setHTML(`<h3>${musico.descripcion}</h3>`)) // Mostrar descripción al hacer clic
            .addTo(this.map);
        });
      },
      addMarker(lngLat) {
        // Eliminar marcador existente si existe
        if (this.marker) {
          this.marker.remove();
        }

        // Crear nuevo marcador en la ubicación del clic
        this.marker = new mapboxgl.Marker()
          .setLngLat(lngLat)
          .addTo(this.map);
      },
      saveMarker(lngLat) {
        axios.post('/api/musicos-coordenadas', {
          lat: lngLat.lat,
          long: lngLat.lng
        })
        .then(response => {
          console.log('Marcador guardado:', response.data);
          // Agregar el nuevo marcador a la lista de músicos
          this.musicos.push(response.data.musico);
        })
        .catch(error => {
          console.error('Error al guardar el marcador:', error);
        });
      },
    },
    beforeUnmount() {
      // Limpiar el mapa antes de destruir el componente
      if (this.map) {
        this.map.remove();
      }
    },
  };
  </script>

  <style scoped>
  #map {
    width: 100%;
    height: 500px; /* Asegúrate de que el contenedor tenga una altura definida */
  }
  </style>
