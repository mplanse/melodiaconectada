<template>
    <div class="container mt-4">
      <h2>Crear Contrato</h2>

      <form @submit.prevent="crearContrato()">
  <div class="mb-3">
    <label for="restaurante" class="form-label">Restaurante</label>
    <select class="form-select" v-model="contrato.restaurante"  name="restaurante" id="restaurante">
        <option v-for="restaurante in restaurantes" :value="restaurante.idRestaurante"> {{ restaurante.usuario.nombre }} </option>
    </select>



    <!-- <select v-model="contrato.idRestaurante" class="form-select" required>
      <option disabled value="">Selecciona un restaurante</option>
      <option
        v-for="restaurante in restaurantes"
        :key="restaurante.idRestaurante"
        :value="restaurante.idRestaurante"
      >
        {{ restaurante.usuario.nombre }} (ID: {{ restaurante.idRestaurante }})
      </option>
    </select> -->
  </div>

  <div class="mb-3">
    <label for="musico" class="form-label">Músico</label>
    <select class="form-select" v-model="contrato.musico"  name="musico" id="musico">
        <option v-for="musico in musicos" :value="musico.idMusico"> {{ musico.usuario.nombre }} </option>
    </select>
    <!-- <select v-model="contrato.idMusico" class="form-select" required>
      <option disabled value="">Selecciona un músico</option>
      <option
        v-for="musico in musicos"
        :key="musico.idMusico"
        :value="musico.idMusico"
      >
        {{ musico.usuario.nombre }} (ID: {{ musico.idMusico }})
      </option>
    </select> -->
  </div>

  <div class="mb-3">
    <label for="precio" class="form-label">Precio</label>
    <input
      type="number"
      v-model.number="contrato.precioContrato"
      class="form-control"
      required
    />
  </div>

  <div class="mb-3">
    <label for="fecha" class="form-label">Fecha</label>
    <input
      type="date"
      v-model="contrato.fechaContrato"
      class="form-control"
      required
    />
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

        }
      };
    },
    mounted() {
      this.obtenerMusicos();
      this.obtenerRestaurantes();
    },
    methods: {

        obtenerMusicos(){

            axios.get('/api/musicos')
            .then(response =>{
                this.musicos=response.data.data;
                console.log(this.musicos)
            } ) .catch(error =>{
                console.log ("error en los datos")
            })

        },

        obtenerRestaurantes(){

axios.get('/api/restaurante')
.then(response =>{
    this.restaurantes=response.data.data;
    console.log(this.restaurantes)
} ) .catch(error =>{
    console.log ("error en los datos")
})

},

        async obtenerUsuarios() {
    try {
      const response = await axios.get('http://localhost/melodiaconectada/docker/melodia-emja/public/api/usuarios');
      const usuarios = response.data;

      this.restaurantes = usuarios.filter(u => u.roles_idRol === 2 && u.restaurante);
      this.musicos = usuarios.filter(u => u.roles_idRol === 1 && u.musico);
    } catch (error) {
      console.error('Error al obtener usuarios:', error);
    }
  },
  async crearContrato() {
        console.log("dentro de crear")
        try {
          const contratoData = {
            idMusico: this.contrato.musico,
            idRestaurante: this.contrato.restaurante,
            fechaContrato: this.contrato.fechaContrato,
            precioContrato: this.contrato.precioContrato
          };

          console.log('Enviando datos del contrato:', contratoData); // Debug

          const response = await axios.post(
            '/contrato',
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

      }

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
