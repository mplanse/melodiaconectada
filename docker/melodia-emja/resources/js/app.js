import './bootstrap';
import { createApp } from 'vue';
import MapComponent from './VUE/mapbox.vue';
import Contrato from './VUE/Contrato.vue';
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8080/melodiaconectada/docker/melodia-emja/public/api';

const app = createApp({});

// Registra los componentes
app.component('map-component', MapComponent);
app.component('contrato-component', Contrato); // Asegúrate de que en el HTML usas <contrato-component>

// Monta la aplicación en el contenedor con id="app"
app.mount('#app');
