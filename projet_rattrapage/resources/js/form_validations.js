document.addEventListener('DOMContentLoaded', function () {
    let form;
    if (document.getElementById('eventForm')) {
        form = document.getElementById('eventForm');
    }
    if (document.getElementById('editEventForm')) {
        form = document.getElementById('editEventForm');
    }
    if (form) {
        form.addEventListener('submit', function (event) {
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
            if (document.getElementById('max_volunteers').value > 10000) {
                errors.push("le max  benevolant doit etre moins de 10 milles");
            }
            let postalCodeRegex = /^[0-9]+$/;

            if (!postalCodeRegex.test(document.getElementById('postal_code').value)) {
                errors.push("le code postale doit etre compose de chiffres")
            }
            let hasNumberRegex = /[0-9]/;
            let villeInput = document.getElementById('ville');
            if (villeInput && hasNumberRegex.test(villeInput.value)) {
                errors.push("La ville ne doit pas contenir de chiffres.");
            }

            let paysInput = document.getElementById('pays');
            if (paysInput && hasNumberRegex.test(paysInput.value)) {
                errors.push("Le pays ne doit pas contenir de chiffres.");
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
    }
});