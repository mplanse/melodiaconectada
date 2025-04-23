<template>
    <div class="eventos-container">
        <div class="cards-grid">
            <div v-for="evento in eventos" :key="evento.idEventos" class="evento-item" @click="navigateToEventoDetails(evento.idEventos)" role="button" tabindex="0">
                <div class="image-container">
                    <!-- Concatenar la URL con 'storage' -->
                    <img v-if="evento.urlMultimedia" :src="`img/${evento.urlMultimedia}`" :alt="evento.nombreEvento" class="evento-image">
                    <div v-else class="placeholder-image">Sin imagen</div>
                </div>
                <div class="evento-content">
                    <h2 class="evento-title">{{ evento.nombreEvento }}</h2>
                    <p class="evento-description">{{ evento.descripcion }}</p>
                    <div class="evento-details">
                        <p class="evento-date"><i class="fas fa-calendar-alt"></i> {{ formatDate(evento.fecha) }}</p>
                        <p class="evento-price"><i class="fas fa-ticket-alt"></i> {{ formatPrice(evento.precio) }}</p>
                    </div>
                    <!-- Botón "Ver detalles" -->
                    <a :href="`eventos/${evento.idEventos}`">Detalles</a>
                </div>
            </div>
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
        },
        formatDate(dateString) {
            if (!dateString) return 'Fecha no disponible';
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('es-ES', options);
        },
        formatPrice(price) {
            if (price === 0 || price === '0') return 'Gratis';
            if (!price) return 'Precio no disponible';
            return `${price}€`;
        },
    }
}
</script>

<style scoped>
.eventos-container {
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}

.cards-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
}

.evento-item {
    display: flex;
    flex-direction: column;
    background-color: transparent; /* Sin fondo */
    height: 100%;
    cursor: pointer;
}

.image-container {
    height: 180px;
    overflow: hidden;
    position: relative;
}

.evento-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.placeholder-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f0f0f0;
    color: #999;
    font-style: italic;
}

.evento-content {
    padding: 1rem 0;
    display: flex;
    flex-direction: column;
}

.evento-title {
    font-size: 1.3rem;
    margin: 0 0 0.5rem;
    color: #fff; /* Texto blanco */
}

.evento-description {
    font-size: 0.9rem;
    color: #ccc; /* Texto gris claro */
    margin-bottom: 0.5rem;
    line-height: 1.5;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    line-clamp: 3;
    -webkit-box-orient: vertical;
}

.evento-details {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.5rem;
    font-size: 0.85rem;
    color: #aaa; /* Texto gris */
}

.evento-date, .evento-price {
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.view-details {
    color: #E09D89; /* Texto rosado */
    font-weight: 500;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    text-decoration: underline;
    cursor: pointer;
}

/* Responsive adjustments */
@media (max-width: 1100px) {
    .cards-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 800px) {
    .cards-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 500px) {
    .eventos-container {
        padding: 1rem;
    }

    .cards-grid {
        grid-template-columns: 1fr;
    }
}
</style>
