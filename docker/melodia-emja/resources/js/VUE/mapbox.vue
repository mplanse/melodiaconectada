<template>
    <div>
        <button @click="activarModoAgregar" class="btn btn-primary mb-2">
            Añadir/Actualizar mi posición
        </button>
        <div id="map" style="width: 100%; height: 500px"></div>
    </div>
</template>

<script>
import mapboxgl from "mapbox-gl";
import axios from "axios";
import "mapbox-gl/dist/mapbox-gl.css";

export default {
    props: {
        musicos: {
            type: Array,
            required: true,
        },
    },
    data() {
        return {
            map: null, // Referencia al mapa
            localMusicos: [], // Variable local para almacenar los datos de músicos
            restaurantes: [], // Variable local para almacenar los datos de restaurantes
            modoAgregar: false,
            marcadorPersonal: null,
            usuarioId: null, // ID del usuario actual, debería pasarse como prop o por el store
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

            // Inicializa el mapa
            this.map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/mapbox/streets-v12",
                center: [2.154007, 41.390205], // Barcelona
                zoom: 12,
            });

            this.map.addControl(new mapboxgl.NavigationControl());

            // Obtener datos de músicos y restaurantes
            this.obtenerMusicos();
            this.obtenerDirecciones();
        },

        // Obtiene los datos de músicos desde el backend
        async obtenerMusicos() {
            try {
                const response = await axios.get(
                    "http://localhost:8080/melodiaconectada/docker/melodia-emja/public/api/obtener-coordenadas"
                ); // Ajusta la URL según tu API
                console.log("Datos recibidos de músicos:", response.data);
                this.localMusicos = response.data.musicos; // Asignar datos a la variable local
                this.agregarMarcadoresMusicos();
            } catch (error) {
                console.error("Error al obtener datos de músicos:", error);
            }
        },

        // Agrega marcadores para los músicos
        agregarMarcadoresMusicos() {
            if (!this.localMusicos || this.localMusicos.length === 0) {
                console.warn(
                    "No hay músicos disponibles para mostrar en el mapa."
                );
                return;
            }

            this.localMusicos.forEach((musico) => {
                new mapboxgl.Marker({ color: "blue" }) // Marcador azul para músicos
                    .setLngLat([musico.long, musico.lat]) // Mapbox usa [longitud, latitud]
                    .setPopup(
                        new mapboxgl.Popup().setHTML(
                            `<h3>${musico.descripcion}</h3>`
                        )
                    )
                    .addTo(this.map);
            });
        },

        // Obtiene las direcciones de los restaurantes desde el backend
        async obtenerDirecciones() {
            try {
                const response = await axios.get(
                    "http://localhost:8080/melodiaconectada/docker/melodia-emja/public/api/obtener-direcciones"
                );
                console.log("Datos recibidos de restaurantes:", response.data);
                this.restaurantes = response.data.restaurantes;

                this.restaurantes.forEach((restaurante) => {
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

                    const coordinates = data.features[0].center;

                    // const nombreUsuario = restaurante.nombreUsuario || "Sin nombre";
                    // const descripcionUsuario = restaurante.descripcionUsuario || "Sin descripción";

                    new mapboxgl.Marker({ color: "red" })
                        .setLngLat(coordinates)
                        .setPopup(
                            new mapboxgl.Popup().setHTML(`
                  <h3>${nombreUsuario}</h3>
                  <p>Dirección: ${restaurante.direccion}</p>
                  <p>Descripción: ${descripcionUsuario}</p>
                `)
                        )
                        .addTo(this.map);

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
        activarModoAgregar() {
            this.modoAgregar = true;
            alert("Haz clic en el mapa para colocar tu ubicación.");
        },
    },

    beforeDestroy() {
        if (this.map) {
            this.map.remove();
        }
    },
};
</script>

<style scoped>
#map {
    width: 100%;
    height: 500px;
}
</style>
