import './bootstrap';
import { createApp } from 'vue';
import MapComponent from './VUE/mapbox.vue';
import LocalComponent from './VUE/locales.vue';
import MultimediaComponent from './VUE/multimedia.vue';
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost:8080/melodiaconectada/docker/melodia-emja/public/api';


const app = createApp({});

// Registra el componente localmente
app.component('map-component', MapComponent);
app.component('local-component', LocalComponent);
app.component('multimedia-component', MultimediaComponent);

// Monta la aplicación en el contenedor con id="app"
app.mount('#app');
