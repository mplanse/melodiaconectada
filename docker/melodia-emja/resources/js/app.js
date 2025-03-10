import './bootstrap';
import { createApp } from 'vue';
import mapboxgl from 'mapbox-gl';
import MapComponent from './VUE/mapbox.vue';

// Configura el token de acceso de Mapbox
mapboxgl.accessToken = 'pk.eyJ1Ijoiam9yZGl0dXMiLCJhIjoiY203d2VoMHgzMDNxcjJxc2Nqd2h3bTN0YyJ9.TcKwh0g8Wl9deYIYYVzK9w';

// Define el componente de Vue para Mapbox
const MapboxComponent = {
    template: '<div id="map" style="width: 100%; height: 400px;"></div>',
    mounted() {
        // Inicializa el mapa cuando el componente se monta
        new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [2.154007, 41.390205], // Barcelona [lng, lat]
            zoom: 12 // Nivel de zoom adecuado
        });

    }
};

// Crea la aplicación Vue
const app = createApp({});

// Registra el componente globalmente
app.component('mapbox-component', MapboxComponent);

// Monta la aplicación en el contenedor con id="app"
app.mount('#app');

