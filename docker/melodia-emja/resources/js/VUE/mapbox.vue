<template>
    <div>
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
            map: null,
            localMusicos: [], // Almacena datos de la API
            marcadorImagen: "/public/img/notaMapa.png", // Imagen fija para todos
        };
    },

    mounted() {
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

            this.obtenerMusicos();
        },

        async obtenerMusicos() {
            try {
                const response = await axios.get(
                    "http://localhost/melodiaconectada/docker/melodia-emja/public/api/obtener-coordenadas"
                );
                console.log("Datos recibidos de la API:", response.data);
                this.localMusicos = response.data.musicos;
                this.agregarMarcadores();
            } catch (error) {
                console.error("Error al obtener datos de músicos:", error);
            }
        },

        agregarMarcadores() {
            if (!this.localMusicos || this.localMusicos.length === 0) {
                console.warn("No hay músicos disponibles para mostrar en el mapa.");
                return;
            }

            this.localMusicos.forEach((musico) => {
                // Crear un elemento div para el marcador con una imagen fija
                const el = document.createElement("div");
                el.className = "marker";
                el.style.backgroundImage = `url(${this.marcadorImagen})`; // Imagen fija
                el.style.width = "40px";
                el.style.height = "40px";
                el.style.backgroundSize = "cover";
                el.style.borderRadius = "50%";
                el.style.cursor = "pointer";

                // Evento click para mostrar información
                el.addEventListener("click", () => {
                    new mapboxgl.Popup()
                        .setLngLat([musico.long, musico.lat])
                        .setHTML(`<h3>${musico.descripcion}</h3>`)
                        .addTo(this.map);
                });

                // Agregar el marcador al mapa
                new mapboxgl.Marker(el)
                    .setLngLat([musico.long, musico.lat])
                    .addTo(this.map);
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

/* Estilo de los marcadores personalizados */
.marker {
    display: flex;
    justify-content: center;
    align-items: center;
    border: 2px solid white;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.3);
}
</style>
