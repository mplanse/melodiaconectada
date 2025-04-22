<template>
    <div>
      <!-- Botón para abrir el modal -->
      <button class="btn btn-primary" @click="openModal">Subir Imagen</button>

      <!-- Modal de subida de imagen -->
      <div class="modal fade show" v-if="isOpen" style="display: block; background: rgba(0, 0, 0, 0.5)">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Subir Imagen</h5>
              <button type="button" class="btn-close" @click="closeModal"></button>
            </div>
            <div class="modal-body">
              <input type="file" @change="handleFileUpload" class="form-control" />
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" @click="closeModal">Cancelar</button>
              <button class="btn btn-success" @click="uploadImage" :disabled="!imagen">Subir</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script>
  import axios from "axios";

  export default {
    data() {
      return {
        isOpen: false,
        imagen: null,
      };
    },
    methods: {
      openModal() {
        this.isOpen = true;
      },
      closeModal() {
        this.isOpen = false;
        this.imagen = null;
      },
      handleFileUpload(event) {
        this.imagen = event.target.files[0];
      },
      async uploadImage() {
        if (!this.imagen) {
          alert("Selecciona una imagen");
          return;
        }

        let formData = new FormData();
        formData.append("imagen", this.imagen);
        formData.append("usuaris_idusuaris", 1); // Aquí pones el ID del usuario autenticado

        try {
          let response = await axios.post("/guardar-imagen", formData, {
            headers: { "Content-Type": "multipart/form-data" },
          });
          console.log(response.data);
          alert("Imagen subida con éxito");
          this.closeModal();
        } catch (error) {
          console.error("Error subiendo imagen", error);
          alert("Error subiendo la imagen");
        }
      },
    },
  };
  </script>

  <style scoped>
  /* Ajustes para centrar el modal */
  .modal-dialog {
    margin-top: 10%;
  }
  </style>
