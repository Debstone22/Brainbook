let clickCount = 0;
const totalClicks = 108;

const progressBar = document.getElementById("progress-bar");
const messageElement = document.getElementById("message");
const clickCountElement = document.getElementById("click-count");
const clickButton = document.getElementById("click-btn");

clickButton.addEventListener("click", () => {
    clickCount++;
    updateProgress();
});

function updateProgress() {
    const progressPercentage = (clickCount / totalClicks) * 100;
    progressBar.style.width = `${progressPercentage}%`;
    clickCountElement.textContent = `Clics: ${clickCount}`;

    if (clickCount >= 108) {
        messageElement.textContent = "¡Excelente, ya terminaste aprendiendo 6 cursos con nuevos temas para ti!";
    } else if (clickCount >= 79) {
        messageElement.textContent = "¡Ya te falta muy poco para terminar bien tu ciclo!";
    } else if (clickCount >= 53) {
        messageElement.textContent = "¡Vamos bien, puedes hacerlo mejor!";
    } else if (clickCount >= 26) {
        messageElement.textContent = "¡Comienza con el pie derecho!";
    }
}