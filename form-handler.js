const form = document.getElementById('contactForm');

form.addEventListener('submit', function(event) {
    event.preventDefault();

    const name = form.name.value.trim();
    const email = form.email.value.trim();
    const phone = form.phoneNumber.value.trim();
    const recaptchaResponse = grecaptcha.getResponse();

    let errorMsg = "";

    // Validar nombre solo letras y espacios
    if (!/^[a-zA-Z ]+$/.test(name)) {
        errorMsg = "El nombre solo puede contener letras y espacios.";
    }
    // Validar email con regex simple (puedes usar más compleja si quieres)
    else if (!/^\S+@\S+\.\S+$/.test(email)) {
        errorMsg = "El correo electrónico no es válido.";
    }
    // Validar teléfono con formato 123-456-7890
    else if (!/^\d{3}-\d{3}-\d{4}$/.test(phone)) {
        errorMsg = "El teléfono debe tener formato 123-456-7890.";
    }
    // Validar reCAPTCHA
    else if (recaptchaResponse.length === 0) {
        errorMsg = "Por favor, verifica el captcha.";
    }

    if (errorMsg) {
        document.getElementById('response').innerText = errorMsg;
        return; // Detener el envío
    }

    // Si pasa validación, enviar con fetch
    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('response').innerHTML = data;
        grecaptcha.reset(); // Resetea el captcha después de enviar
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById('response').innerText = "Error enviando el formulario.";
    });
});
