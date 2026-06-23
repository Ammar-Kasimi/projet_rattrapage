document.addEventListener('DOMContentLoaded', function () {
    console.log('works')
    if (document.getElementById('js-errors')) {
        let form;


        if (document.getElementById('eventForm')) {
            form = document.getElementById('eventForm');
        }
        if (document.getElementById('editEventForm')) {
            form = document.getElementById('editEventForm');
        }

        if (form) {
            form.addEventListener('submit', function (event) {
                document.getElementById('js-errors').classList.add('hidden');
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
                    showErrors(errors);
                }
            });
        }

        let profileForm = document.getElementById('editProfileForm');

        if (profileForm) {
            console.log('enters')

            profileForm.addEventListener('submit', function (event) {
                document.getElementById('js-errors').classList.add('hidden');
                let errors = []; let email = document.getElementById('email').value;
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailRegex.test(email)) {
                    errors.push("Veuillez entrer une adresse email valide.");
                }

                let age = document.getElementById('age').value;
                if (age < 1 && age != '') {
                    errors.push("L'âge doit être supérieur ou égal à 1.");
                }

                if (errors.length > 0) {
                    event.preventDefault();
                    showErrors(errors);
                }
            });
        }

        let passwordForm = document.getElementById('editPasswordForm');

        if (passwordForm) {
            passwordForm.addEventListener('submit', function (event) {
                document.getElementById('js-errors').classList.add('hidden');
                let errors = [];
                let password = document.getElementById('password').value;
                let confirmPassword = document.getElementById('password_confirmation').value;

                if (password.length < 8) {
                    errors.push("Le mot de passe doit contenir au moins 8 caractères.");
                }
                if (password !== confirmPassword) {
                    errors.push("Les mots de passe ne correspondent pas.");
                }

                if (errors.length > 0) {
                    event.preventDefault();
                    showErrors(errors);
                }
            });
        }
        let registerForm = document.getElementById('registerForm');

        if (registerForm) {
            registerForm.addEventListener('submit', function (event) {
                document.getElementById('js-errors').classList.add('hidden');
                let errors = [];

                let email = document.getElementById('email').value;
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    errors.push("Veuillez entrer une adresse email valide.");
                }

                let password = document.getElementById('password').value;
                let confirmPassword = document.getElementById('password_confirmation').value;

                if (password.length < 8) {
                    errors.push("Le mot de passe doit contenir au moins 8 caractères.");
                }
                if (password !== confirmPassword) {
                    errors.push("Les mots de passe ne correspondent pas.");
                }
                let ageInput = document.getElementById('age').value;
                if (ageInput !== "" && ageInput < 1) {
                    errors.push("L'âge doit être supérieur ou égal à 1.");
                }

                if (errors.length > 0) {
                    event.preventDefault();
                    showErrors(errors);
                }
            });
        }
        let loginForm = document.getElementById('loginForm');

        if (loginForm) {
            loginForm.addEventListener('submit', function (event) {
                document.getElementById('js-errors').classList.add('hidden');
                let errors = [];

                let email = document.getElementById('login_email').value;
                let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (!emailRegex.test(email)) {
                    errors.push("Veuillez entrer une adresse email valide.");
                }

                let password = document.getElementById('login_password').value;
                if (password.trim() === '') {
                    errors.push("Le mot de passe est requis.");
                }

                if (errors.length > 0) {
                    event.preventDefault();
                    showErrors(errors);
                }
            });
        }

        let categoryForm = document.getElementById('categoryForm');

        if (categoryForm) {
            categoryForm.addEventListener('submit', function (event) {
                document.getElementById('js-errors').classList.add('hidden');
                let errors = [];

                let nameInput = document.getElementById('category_name').value.trim();
                let descInput = document.getElementById('category_desc').value.trim();
                if (nameInput == '') {
                    errors.push("Le nom de la catégorie est requis.");
                } else if (nameInput.length > 45) {
                    errors.push("Le nom de la catégorie ne peut pas dépasser 45 caractères.");
                }
                if (descInput !== '' && descInput.length < 3) {
                    errors.push("La description doit contenir au moins 3 caractères si elle est renseignée.");
                }

                if (errors.length > 0) {
                    event.preventDefault();
                    showErrors(errors);
                }
            });
        }

        let editCategoryForm = document.getElementById('editCategoryForm');

        if (editCategoryForm) {
            editCategoryForm.addEventListener('submit', function (event) {
                document.getElementById('js-errors').classList.add('hidden');
                let errors = [];

                let nameInput = document.getElementById('edit_category_name').value.trim();
                let descInput = document.getElementById('edit_category_desc').value.trim();

                if (nameInput === '') {
                    errors.push("Le nom de la catégorie est requis.");
                } else if (nameInput.length > 45) {
                    errors.push("Le nom de la catégorie ne peut pas dépasser 45 caractères.");
                }

                if (descInput !== '' && descInput.length < 3) {
                    errors.push("La description doit contenir au moins 3 caractères si elle est renseignée.");
                }

                if (errors.length > 0) {
                    event.preventDefault();
                    showErrors(errors);
                }
            });
        }


        function showErrors(errorsArray) {
            document.getElementById('error-list').innerHTML = '';

            errorsArray.forEach(function (error) {
                let li = document.createElement('li');
                li.textContent = error;
                document.getElementById('error-list').appendChild(li);
            });

            document.getElementById('js-errors').classList.remove('hidden');
        }
    }
});