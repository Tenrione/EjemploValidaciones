<?php
require_once("ClaseValidacion.php");

$secretKey = "6LeTYmArAAAAACG6PrtlqRjM4VrbgaQ9t1w2kIBD";  // Clave privada que te dio Google
$responseKey = $_POST['g-recaptcha-response'] ?? '';
$userIP = $_SERVER['REMOTE_ADDR'];
$name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
$number = trim(filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_STRING));

$validator = new FormValidator($_POST);
$validator->setRequiredFields(['name', 'email', 'phoneNumber']); 

$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";

$response = file_get_contents($url);
$response = json_decode($response);

$errors = [];

try {
    $validator->validate();

    if (!$response->success) {
        $errors[] = "Por favor, verifica el captcha.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (!preg_match('/^\d{3}-\d{3}-\d{4}$/', $number)) {
        $errors[] = "Número de teléfono inválido. Debe tener formato 123-456-7890.";
    }

    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors[] = "Solo se permiten letras y espacios en el nombre.";
    }

    if (!empty($errors)) {
        echo implode("<br>", $errors);
        exit;
    }

    // Si no hay errores, procesar formulario
    echo "Form submitted successfully";

} catch (Exception $e) {
    echo $e->getMessage();
}
?>
