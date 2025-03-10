import './bootstrap';
import { createApp } from 'vue';
import MapComponent from './VUE/mapbox.vue';  // Ajusta la ruta según corresponda

const app = createApp({});

// Registra el componente localmente
app.component('map-component', MapComponent);

// Monta la aplicación en el contenedor con id="app"
app.mount('#app');
