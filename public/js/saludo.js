// Obtener la hora actual
const myDate = new Date();
const hours = myDate.getHours();
let greeting;

// Determinar el saludo basado en la hora
if (hours < 12) {
    greeting = "¡Buen día!";
} else if (hours < 18) {
    greeting = "¡Buena tarde!";
} else {
    greeting = "¡Buenas noches!";
}

// Mostrar el saludo en el HTML
document.getElementById("greeting").innerText = greeting;