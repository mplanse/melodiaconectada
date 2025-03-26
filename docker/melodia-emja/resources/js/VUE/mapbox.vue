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
            localMusicos: [], // Variable local para almacenar los datos de la API
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
