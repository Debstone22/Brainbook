function filterQuestions() {
    const filterValue = document.getElementById('filter').value;
    const questions = document.querySelectorAll('.question');

    questions.forEach(question => {
        if (filterValue === 'Todo' || question.getAttribute('data-category') === filterValue) {
            question.style.display = 'block'; // Muestra la pregunta
        } else {
            question.style.display = 'none'; // Oculta la pregunta
        }
    });
}