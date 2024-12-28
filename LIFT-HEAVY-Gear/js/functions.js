//burger menu a comparsa
document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menu-toggle');
    const dropdownMenu = document.getElementById('dropdown-menu');

    menuToggle.addEventListener('click', (e) => {
        e.preventDefault();
        dropdownMenu.classList.toggle('hidden');
    });
});

let currentIndex = 0; // Indice dell'immagine visibile
const images = document.querySelectorAll(".image-container img"); // Seleziona tutte le immagini
const totalImages = images.length; // Numero totale di immagini

function showImage(index) {
    const container = document.querySelector(".image-container");
    if (index < 0) {
        currentIndex = totalImages - 1; // Torna all'ultima immagine
    } else if (index >= totalImages) {
        currentIndex = 0; // Torna alla prima immagine
    } else {
        currentIndex = index;
    }
    // Sposta il contenitore per mostrare l'immagine corrente
    container.style.transform = `translateX(-${currentIndex * 100}%)`;
}

function prevImage() {
    showImage(currentIndex - 1); // Mostra l'immagine precedente
}

function nextImage() {
    showImage(currentIndex + 1); // Mostra l'immagine successiva
}
