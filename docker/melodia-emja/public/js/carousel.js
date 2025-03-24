document.addEventListener("DOMContentLoaded", () => {
    const carousel = document.querySelector(".carousel");
    const images = carousel.querySelectorAll("img");
    const leftButton = document.querySelector(".carousel-button.left");
    const rightButton = document.querySelector(".carousel-button.right");

    let currentIndex = 0;
    const totalImages = images.length;

    // Función para actualizar la clase "active" en las imágenes
    const updateActiveImage = () => {
        images.forEach((img, index) => {
            img.classList.remove("active");
            if (index === currentIndex) {
                img.classList.add("active");
            }
        });
    };

    // Función para mover el carrusel
    const moveCarousel = (direction) => {
        if (direction === "right") {
            currentIndex = (currentIndex + 1) % totalImages;
        } else if (direction === "left") {
            currentIndex = (currentIndex - 1 + totalImages) % totalImages;
        }
        updateActiveImage();
    };

    // Botones de navegación
    leftButton.addEventListener("click", () => moveCarousel("left"));
    rightButton.addEventListener("click", () => moveCarousel("right"));

    // Pase automático cada 5 segundos
    setInterval(() => moveCarousel("right"), 5000);

    // Inicializa la imagen activa
    updateActiveImage();
});