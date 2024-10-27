<script>
    // Función para mostrar la fecha actual
    function showCurrentDate() {
        const date = new Date();
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        document.getElementById('currentDate').innerText = date.toLocaleDateString('es-ES', options);
    }

    // Función para generar los días del mes
    function generateCalendarDays() {
        const date = new Date();
        const month = date.getMonth();
        const year = date.getFullYear();
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        
        let daysHtml = '';
        for (let i = 1; i <= lastDay.getDate(); i++) {
            daysHtml += `<div>${i}</div>`;
        }
        document.getElementById('calendarDays').innerHTML = daysHtml;
    }
