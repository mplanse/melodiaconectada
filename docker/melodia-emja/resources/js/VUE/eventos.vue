<template>
    <div>
        <div v-for="evento in eventos" :key="evento.idEventos">
            <h1>{{ evento.nombreEvento }}</h1>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            eventos: []
        }
    },
    mounted() {
        this.fetchEventos();
    },
    methods: {
        fetchEventos() {
            axios.get('/api/getEventos')
                .then(response => {
                    this.eventos = response.data;
                })
                .catch(error => {
                    console.error("Error fetching eventos:", error);
                });
        }
    }
}
</script>

<style scoped>

</style>
