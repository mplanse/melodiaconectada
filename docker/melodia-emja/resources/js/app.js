import './bootstrap';
import { createApp } from 'vue';
import MapComponent from './VUE/mapbox.vue';
import LocalComponent from './VUE/locales.vue';
import MultimediaComponent from './VUE/multimedia.vue';
import Contrato from './VUE/Contrato.vue';
import Eventos from './VUE/eventos.vue';
import axios from 'axios';

axios.defaults.baseURL = 'http://localhost/melodiaconectada/docker/melodia-emja/public/api';

const app = createApp({});

// Registra los componentes
app.component('map-component', MapComponent);
app.component('local-component', LocalComponent);
app.component('multimedia-component', MultimediaComponent);
app.component('contrato-component', Contrato);
app.component('eventos', Eventos) // Asegúrate de que en el HTML usas <contrato-component>

// Monta la aplicación en el contenedor con id="app"
app.mount('#app');
