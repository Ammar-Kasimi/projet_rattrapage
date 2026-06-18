document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('eventForm').addEventListener('submit', function (event) {
        let errors = [];
        if (document.getElementById('date').value) {
            let selectedDate = new Date(document.getElementById('date').value);
            let today = new Date();
            if (selectedDate < today) {
                errors.push("La date de l'événement ne peut pas être dans le passé.");
            }
        }
        if (document.getElementById('max_volunteers').value < 1) {
            errors.push("le max  benevolant doit etre >=1");
        }
        if (errors.length > 0) {
            event.preventDefault();
            document.getElementById('error-list').innerHTML = '';

            errors.forEach(function (error) {
                let li = document.createElement('li');
                li.textContent = error;
                document.getElementById('error-list').appendChild(li);
            });

            document.getElementById('js-errors').classList.remove('hidden');
        }
    }
    );
});