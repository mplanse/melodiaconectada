import './bootstrap';
import { createApp } from 'vue';
import MapComponent from './VUE/mapbox.vue';
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8080/api';


const app = createApp({});

// Registra el componente localmente
app.component('map-component', MapComponent);

// Monta la aplicación en el contenedor con id="app"
app.mount('#app');
