<template>
    <div class="container mt-4">
      <h2>Crear Contrato</h2>

      <form @submit.prevent="crearContrato">
        <div class="mb-3">
          <label for="restaurante" class="form-label">Restaurante</label>
          <select v-model="contrato.idRestaurante" class="form-select" required>
            <option v-for="restaurante in restaurantes" :key="restaurante.idRestaurante" :value="restaurante.idRestaurante">
              {{ restaurante.usuario.nombre }} ( {{ restaurante.idRestaurante }})
            </option>
          </select>
        </div>

        <div class="mb-3">
          <label for="musico" class="form-label">Músico</label>
          <select v-model="contrato.idMusico" class="form-select" required>
            <option v-for="musico in musicos" :key="musico.idMusico" :value="musico.idMusico">
              {{ musico.usuario.nombre }} ( {{ musico.idMusico }})
            </option>
          </select>
        </div>

        <div class="mb-3">
          <label for="precio" class="form-label">Precio</label>
          <input type="number" v-model="contrato.precioContrato" class="form-control" required />
        </div>

        <div class="mb-3">
          <label for="fecha" class="form-label">Fecha</label>
          <input type="date" v-model="contrato.fechaContrato" class="form-control" required />
        </div>

        <button type="submit" class="btn btn-primary">Crear Contrato</button>
      </form>
    </div>
  </template>

  <script>
  import axios from 'axios';

  export default {
    data() {
      return {
        restaurantes: [],
        musicos: [],
        contrato: {
          idRestaurante: '',
          idMusico: '',
          fechaContrato: '',
          precioContrato: ''
        }
      };
    },
    mounted() {
      this.obtenerContratos();
    },
    methods: {
      async obtenerContratos() {
        try {
          const response = await axios.get('http://localhost/melodiaconectada/docker/melodia-emja/public/api/contrato');
          const contratos = response.data.data;

          this.restaurantes = contratos.map(c => c.restaurante).filter((v, i, a) => a.findIndex(t => (t.idRestaurante === v.idRestaurante)) === i);
          this.musicos = contratos.map(c => c.musico).filter((v, i, a) => a.findIndex(t => (t.idMusico === v.idMusico)) === i);
        } catch (error) {
          console.error('Error al obtener contratos:', error);
        }
      },
      async crearContrato() {
        try {
          const contratoData = {
            idMusico: this.contrato.idMusico,
            idRestaurante: this.contrato.idRestaurante,
            fechaContrato: this.contrato.fechaContrato,
            precioContrato: this.contrato.precioContrato
          };

          console.log('Enviando datos del contrato:', contratoData); // Debug

          const response = await axios.post(
            'http://localhost/melodiaconectada/docker/melodia-emja/public/api/contrato',
            contratoData,
            { headers: { 'Content-Type': 'application/json' } }
          );

          console.log('Respuesta del servidor:', response.data); // Debug
          alert('Contrato creado exitosamente');
          this.contrato = { idRestaurante: '', idMusico: '', fechaContrato: '', precioContrato: '' };
        } catch (error) {
          console.error('Error al crear contrato:', error.response ? error.response.data : error);
          alert('Error al crear contrato. Revisa la consola para más detalles.');
        }
      }
    }
  };
  </script>

  <style scoped>
  .container {
    max-width: 600px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  </style>
