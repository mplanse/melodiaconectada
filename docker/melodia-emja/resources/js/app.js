import './bootstrap';
import { createApp } from 'vue';
import axios from 'axios';
import mapboxgl from 'mapbox-gl';

// Configura tu token de acceso de Mapbox
mapboxgl.accessToken = 'YOUR_MAPBOX_ACCESS_TOKEN';

// Define un componente Vue para Mapbox
const MapboxComponent = {
    template: '<div id="map" style="width: 100%; height: 400px;"></div>',
    mounted() {
        // Inicializa el mapa cuando el componente se monta
        new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-74.5, 40], // Coordenadas iniciales [longitud, latitud]
            zoom: 9 // Nivel de zoom inicial
        });
    }
};

const app = createApp({});
app.component('mapbox-component', MapboxComponent);
app.mount('#app');

