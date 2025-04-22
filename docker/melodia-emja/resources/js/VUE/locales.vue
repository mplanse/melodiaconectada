<template>
    <div>
        <!-- Contenedor del mapa -->
        <div id="map" style="width: 100%; height: 500px"></div>
    </div>
</template>

<script>
import mapboxgl from "mapbox-gl";
import axios from "axios";
import "mapbox-gl/dist/mapbox-gl.css";

export default {
    data() {
        return {
            map: null, // Referencia al mapa
        };
    },
    mounted() {
        this.initializeMap();
    },
    methods: {
        // Inicializa el mapa
        initializeMap() {
            mapboxgl.accessToken =
                "pk.eyJ1Ijoiam9yZGl0dXMiLCJhIjoiY203d2VoMHgzMDNxcjJxc2Nqd2h3bTN0YyJ9.TcKwh0g8Wl9deYIYYVzK9w";

            // Inicializa el mapa sin coordenadas iniciales
            this.map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/mapbox/streets-v12",
                center: [2.154007, 41.390205], // Barcelona
                zoom: 12,
            });

            // Agregar controles de navegación
            this.map.addControl(new mapboxgl.NavigationControl());

            this.obtenerDirecciones(); // Llama a la función para obtener direcciones
        },

        // Obtiene las direcciones de los restaurantes desde el backend
        async obtenerDirecciones() {
            try {
                const response = await axios.get(
                    "/obtener-direcciones"
                ); // Ajusta la URL según tu servidor
                const restaurantes = response.data.restaurantes;

                // Iterar sobre cada restaurante y geocodificar su dirección
                restaurantes.forEach((restaurante) => {
                    this.geocodificarDireccion(restaurante);
                });
            } catch (error) {
                console.error(
                    "Error al obtener direcciones desde el backend:",
                    error
                );
            }
        },

        // Geocodifica una dirección y agrega un marcador al mapa
        geocodificarDireccion(restaurante) {
            const address = restaurante.direccion;

            // Usa Mapbox Geocoding API para convertir la dirección en coordenadas
            fetch(
                `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(
                    address
                )}.json?access_token=${mapboxgl.accessToken}`
            )
                .then((response) => response.json())
                .then((data) => {
                    if (!data.features || data.features.length === 0) {
                        console.error(
                            `Error: No se pudo geocodificar la dirección: ${address}`
                        );
                        return;
                    }

                    // Extraer las coordenadas
                    const coordinates = data.features[0].center;

                    // Manejar valores nulos para nombre y descripción
                    const nombreUsuario = restaurante.nombreUsuario || "Sin nombre";
                    const descripcionUsuario = restaurante.descripcionUsuario || "Sin descripción";

                    // Agregar un marcador al mapa
                    new mapboxgl.Marker()
                        .setLngLat(coordinates)
                        .setPopup(
                            new mapboxgl.Popup().setHTML(`
                  <h4>${nombreUsuario}</h4>
                  <p>Dirección: ${restaurante.direccion}</p>
                  <p>Descripción: ${descripcionUsuario}</p>
                `)
                        )
                        .addTo(this.map);

                    // Ajustar el centro del mapa si es el primer marcador
                    if (this.map.getZoom() === 2) {
                        this.map.setCenter(coordinates);
                        this.map.setZoom(10);
                    }
                })
                .catch((error) => {
                    console.error(
                        `Error al geocodificar la dirección: ${address}`,
                        error
                    );
                });
        },
    },
};
</script>

<style scoped>
#map {
    width: 100%;
    height: 500px;
}
</style>
