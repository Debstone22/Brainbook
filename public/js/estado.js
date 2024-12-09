document.addEventListener("DOMContentLoaded", function () {
    const combos = document.querySelectorAll(".estado-combo");

    combos.forEach(combo => {
        combo.addEventListener("change", function () {
            const idUsuario = this.getAttribute("data-id-usuario");
            const idCurso = this.getAttribute("data-id-curso");
            const numeroSemana = this.getAttribute("data-numero-semana");
            const idEstado = this.value;

            // Enviar solicitud AJAX al backend
            fetch("../../dashboard/admin_progreso/actualizar_estado.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
                body: `id_usuario=${idUsuario}&id_curso=${idCurso}&numero_semana=${numeroSemana}&id_estado=${idEstado}`,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    alert("Ocurrió un error al actualizar el estado");
                });
        });
    });
});