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
            console.log("Usuario ID:", this.usuarioId);
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
        center: [2.154007, 41.390205], // Barcelona
        zoom: 12,
    });

    this.map.addControl(new mapboxgl.NavigationControl());

    // 👉 Agregar escucha del clic para añadir marcador personal
    this.map.on("click", (e) => {
        if (this.modoAgregar) {
            const { lng, lat } = e.lngLat;

            // Si ya existe el marcador, lo mueve. Si no, lo crea.
            if (this.marcadorPersonal) {
                this.marcadorPersonal.setLngLat([lng, lat]);
            } else {
                this.marcadorPersonal = new mapboxgl.Marker({ color: "green" })
                    .setLngLat([lng, lat])
                    .addTo(this.map);
            }

            this.store(lat, lng); // Guardar en la base de datos
            this.modoAgregar = false; // Desactiva el modo agregar después de usarlo
        }
    });

    this.obtenerMusicos();
    this.obtenerDirecciones();
},


        async obtenerMusicos() {
            try {
                const response = await axios.get(
                    "http://localhost/melodianuevo/melodiaconectada/docker/melodia-emja/public/api/obtener-coordenadas"
                ); // Ajusta la URL según tu API
                console.log("Datos recibidos de músicos:", response.data);
                this.localMusicos = response.data.musicos; // Asignar datos a la variable local
                this.agregarMarcadoresMusicos();
            } catch (error) {
                console.error("Error al obtener datos de músicos:", error.response.data);
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
                            `<h5>${musico.descripcion}</h5>`
                        )
                    )
                    .addTo(this.map);
            });
        },

        async obtenerDirecciones() {
            try {
                const response = await axios.get(
                    "/obtener-direcciones"
                ); // Ajusta la URL según tu servidor
                console.log("Datos recibidos de restaurantes:", response.data);
                this.restaurantes = response.data.restaurantes; // Asignar datos a la variable local

                // Iterar sobre cada restaurante y geocodificar su dirección
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
                  <h5>${nombreUsuario}</h5 >
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

                if (this.marcadorPersonal) {
                    this.marcadorPersonal.remove();
                }

                this.marcadorPersonal = new mapboxgl.Marker({ color: "green" })
                    .setLngLat([lng, lat])
                    .addTo(this.map);

                this.store(lat, lng);
            });
        },

        store(lat, long) {
            axios
                .post(
                    "/store",
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
