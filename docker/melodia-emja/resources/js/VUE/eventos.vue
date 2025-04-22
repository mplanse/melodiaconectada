<template>
    <div class="eventos-container">
        <div class="cards-grid">
            <div v-for="evento in eventos" :key="evento.idEventos"
                class="evento-card"
                @click="navigateToEventoDetails(evento.idEventos)"
                role="button"
                tabindex="0">
                <div class="image-container">
                    <img v-if="evento.urlMultimedia" :src="`img/eventos/${evento.urlMultimedia}`" :alt="evento.nombreEvento" class="evento-image">
                    <div v-else class="placeholder-image">Sin imagen</div>
                </div>
                <div class="card-content">
                    <h2 class="evento-title">{{ evento.nombreEvento }}</h2>
                    <p class="evento-description">{{ evento.descripcion }}</p>
                    <div class="evento-details">
                        <p class="evento-date"><i class="fas fa-calendar-alt"></i> {{ formatDate(evento.fecha) }}</p>
                        <p class="evento-price"><i class="fas fa-ticket-alt"></i> {{ formatPrice(evento.precio) }}</p>
                    </div>
                    <div class="view-details">Ver detalles</div>
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
        navigateToEventoDetails(eventoId) {
            // Replace with your actual navigation logic
            // For example with vue-router:
            // this.$router.push(`/eventos/${eventoId}`);
        }
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

.evento-card {
    display: flex;
    flex-direction: column;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    background-color: white;
    height: 100%;
    cursor: pointer;
}

.evento-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
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
    transition: transform 0.3s ease;
}

.evento-card:hover .evento-image {
    transform: scale(1.05);
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

.card-content {
    padding: 1.25rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.evento-title {
    font-size: 1.3rem;
    margin: 0 0 0.75rem;
    color: #333;
}

.evento-description {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.75rem;
    line-height: 1.5;
    flex-grow: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}

.evento-details {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    font-size: 0.85rem;
    color: #555;
}

.evento-date, .evento-price {
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.view-details {
    color: #3498db;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
    transition: color 0.2s ease;
    font-size: 0.9rem;
}

.view-details::after {
    content: "→";
    font-size: 1.1em;
    transition: transform 0.2s ease;
}

.evento-card:hover .view-details {
    color: #2980b9;
}

.evento-card:hover .view-details::after {
    transform: translateX(4px);
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
