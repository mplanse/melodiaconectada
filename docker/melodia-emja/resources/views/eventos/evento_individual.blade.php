@extends('layouts.layout')

@section('content')
<div class="container mt-5" id="app">
    <event-detail
    :eventid="{{ json_encode($id) }}"
    event-url="{{ url('/eventos') }}">
</event-detail>

</div>

<!-- Vue.js -->
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    Vue.component('event-detail', {
        props: ['eventid','eventUrl'],
        data() {
            return {
                event: null,
                error: null,
                loading: true
            };
        },
        mounted() {
            axios.get(this.eventUrl + '/' + this.eventid)
                .then(res => {
                    this.event = res.data;
                })
                .catch(err => {
                    this.error = 'No se pudo cargar el evento.';
                    console.error(err);
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        template: `
            <div>
                <div v-if="loading" class="text-center my-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Cargando...</span>
                    </div>
                </div>

                <div v-else-if="error" class="alert alert-danger">
                    @{{ error }}
                </div>

                <div v-else-if="event">
                    <h2>@{{ event.nombreEvento }}</h2>
                    <p><strong>Descripción:</strong> @{{ event.descripcion }}</p>
                    <p><strong>Fecha:</strong> @{{ event.fecha }}</p>
                    <p><strong>Precio:</strong> @{{ event.precio }} €</p>

                    <div v-if="event.urlMultimedia">
                        <img :src="event.urlMultimedia" alt="Imagen del evento" class="img-fluid rounded" style="max-width: 300px;">
                    </div>
                    <div v-else class="text-muted">Sin imagen</div>
                </div>
            </div>
        `
    });

    new Vue({
        el: '#app'
    });
</script>
@endsection
