<!DOCTYPE html>
<html>
<head>
    <title>Validaciones con Fetch</title>
</head>
<body>

<h2>Ejemplo de Validaciones</h2>
<div id="response"></div>
<br>
<form id="contactForm" action="process.php" method="post">
    Name: <input type="text" name="name"><br><br>
    Email: <input type="text" name="email"><br><br>
    Phone Number: <input type="text" name="phoneNumber"><br><br>
     <div class="g-recaptcha" data-sitekey="6LeTYmArAAAAAKvLBqSzharQ8MFURSBNSUlt6Dgz"></div><br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<!-- Coloca esto justo antes de cerrar </body> -->
<script src="form-handler.js" defer></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>