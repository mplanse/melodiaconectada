import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import mapboxgl from 'mapbox-gl';

// Define el componente de Vue para Mapbox
const MapboxComponent = {
    template: '<div id="map" style="width: 100%; height: 400px;"></div>',
    mounted() {
        // Configura el token de acceso de Mapbox
        mapboxgl.accessToken = 'YOUR_MAPBOX_ACCESS_TOKEN';

        // Inicializa el mapa cuando el componente se monta
        new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-74.5, 40], // Coordenadas iniciales [longitud, latitud]
            zoom: 9 // Nivel de zoom inicial
        });
    }
};

// Crea la aplicación Vue
const app = createApp({});

// Registra el componente globalmente
app.component('mapbox-component', MapboxComponent);

// Monta la aplicación en el contenedor con id="app"
app.mount('#app');
