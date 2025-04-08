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
            required: false,
            default: () => [],
        },
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            map: null,
            localMusicos: [],
            restaurantes: [],
            modoAgregar: false,
            marcadorPersonal: null,
            usuarioId: null,
        };
    },

    mounted() {
        if (this.user && this.user.idUsuario) {
            this.usuarioId = this.user.idUsuario;
            this.initializeMap();
        } else {
            console.error("No se ha proporcionado el usuario correctamente.");
        }
        this.initializeMap();
    },

    methods: {
        initializeMap() {
            mapboxgl.accessToken =
                "pk.eyJ1Ijoiam9yZGl0dXMiLCJhIjoiY203d2VoMHgzMDNxcjJxc2Nqd2h3bTN0YyJ9.TcKwh0g8Wl9deYIYYVzK9w";

            this.map = new mapboxgl.Map({
                container: "map",
                style: "mapbox://styles/mapbox/streets-v12",
                center: [2.154007, 41.390205],
                zoom: 12,
            });

            this.map.addControl(new mapboxgl.NavigationControl());

            this.obtenerMusicos();
            this.obtenerDirecciones();
        },

        async obtenerMusicos() {
            try {
                const response = await axios.get(
                    "http://localhost:80/melodiaconectada/docker/melodia-emja/public/api/obtener-coordenadas"
                );
                this.localMusicos = response.data.musicos;
                this.agregarMarcadoresMusicos();
            } catch (error) {
                console.error("Error al obtener datos de músicos:", error);
            }
        },

        agregarMarcadoresMusicos() {
            if (!this.localMusicos || this.localMusicos.length === 0) {
                console.warn(
                    "No hay músicos disponibles para mostrar en el mapa."
                );
                return;
            }

            this.localMusicos.forEach((musico) => {
                new mapboxgl.Marker({ color: "blue" })
                    .setLngLat([musico.long, musico.lat])
                    .setPopup(
                        new mapboxgl.Popup().setHTML(
                            `<h3>${musico.descripcion}</h3>`
                        )
                    )
                    .addTo(this.map);
            });
        },

        async obtenerDirecciones() {
            try {
                const response = await axios.get(
                    "http://localhost:80/melodiaconectada/docker/melodia-emja/public/api/obtener-direcciones"
                );
                this.restaurantes = response.data.restaurantes;

                this.restaurantes.forEach((restaurante) => {
                    this.geocodificarDireccion(restaurante);
                });
            } catch (error) {
                console.error("Error al obtener direcciones:", error);
            }
        },

        geocodificarDireccion(restaurante) {
            const address = restaurante.direccion;

            fetch(
                `https://api.mapbox.com/geocoding/v5/mapbox.places/${encodeURIComponent(
                    address
                )}.json?access_token=${mapboxgl.accessToken}`
            )
                .then((response) => response.json())
                .then((data) => {
                    if (!data.features || data.features.length === 0) {
                        console.error(`No se pudo geocodificar: ${address}`);
                        return;
                    }

                    const coordinates = data.features[0].center;
                    const nombreUsuario =
                        restaurante.nombreUsuario || "Sin nombre";
                    const descripcionUsuario =
                        restaurante.descripcionUsuario || "Sin descripción";

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
                })
                .catch((error) => {
                    console.error(`Error al geocodificar ${address}:`, error);
                });
        },

        activarModoAgregar() {
            this.modoAgregar = true;
            alert("Haz clic en el mapa para colocar tu ubicación.");

            this.map.once("click", (e) => {
                const lng = e.lngLat.lng;
                const lat = e.lngLat.lat;

                // Eliminar marcador anterior si existe
                if (this.marcadorPersonal) {
                    this.marcadorPersonal.remove();
                }

                // Crear nuevo marcador verde
                this.marcadorPersonal = new mapboxgl.Marker({ color: "green" })
                    .setLngLat([lng, lat])
                    .addTo(this.map);

                // Enviar al backend
                this.enviarUbicacion(lat, lng);
            });
        },

        async enviarUbicacion(lat, long) {
            try {
                const response = await axios.post(
                    "http://localhost:80/melodiaconectada/docker/melodia-emja/public/api/guardar-coordenadas",
                    {
                        idUsuario: this.usuarioId,
                        lat: lat,
                        long: long,
                    }
                );
                alert("Ubicación actualizada correctamente");
                console.log("Respuesta del backend:", response.data);
            } catch (error) {
                console.error("Error al enviar la ubicación:", error);
                alert("No se pudo actualizar la ubicación.");
            }
        },
        guardarUbicacion(lat, long) {
            axios
                .post(
                    "http://localhost:80/melodiaconectada/docker/melodia-emja/public/api/guardar-ubicacion",
                    {
                        idUsuario: this.usuarioId,
                        lat: lat,
                        long: long,
                    }
                )
                .then((response) => {
                    alert("Ubicación guardada correctamente");
                    console.log("Respuesta:", response.data);
                })
                .catch((error) => {
                    console.error("Error al guardar la ubicación:", error);
                    alert("Hubo un error al guardar la ubicación");
                });
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
