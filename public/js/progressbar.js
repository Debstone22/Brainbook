// Función para mostrar mensajes según el porcentaje
function obtenerMensaje(porcentaje) {
    if (porcentaje === 0) return "¡Comienza con el pie derecho en este nuevo ciclo!";
    if (porcentaje >= 25 && porcentaje < 50) return "¡Buen inicio! Sigue adelante.";
    if (porcentaje >= 50 && porcentaje < 75) return "¡Vas a mitad de camino, no pierdas el ritmo!";
    if (porcentaje >= 75 && porcentaje < 98) return "¡Casi lo logras, tú puedes!";
    if (porcentaje >= 98) return "¡Felicidades, haz completado tu ciclo con éxito!";
    return `Progreso actual: ${porcentaje}%`;
}

// Función para actualizar el progreso desde el servidor
async function actualizarProgreso() {
    try {
        // Llamada al backend para obtener el porcentaje
        const response = await fetch('../../dashboard/admin_progreso/mostrar_progreso.php'); // Cambia 'ruta_a_tu_php.php' a la ruta de tu archivo PHP
        const data = await response.json();

        // Validar datos
        if (data && data.porcentaje !== undefined) {
            const porcentaje = data.porcentaje;

            // Actualizar la barra de progreso
            const progressBar = document.getElementById('progressBar');
            const progressMessage = document.getElementById('progressMessage');

            // Cambiar el ancho de la barra y el texto dinámicamente
            progressBar.style.width = porcentaje + '%';
            progressBar.textContent = porcentaje + '%';

            // Actualizar el mensaje dinámico basado en el porcentaje
            progressMessage.textContent = obtenerMensaje(porcentaje);
        } else {
            console.error('Error al obtener el progreso');
        }
    } catch (error) {
        console.error('Error:', error);
    }
}

// Llama a la función al cargar la página
document.addEventListener('DOMContentLoaded', actualizarProgreso);

// Puedes añadir una función para actualizar manualmente si es necesario (por ejemplo, al hacer clic en un botón)