<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate name
    $name = test_input($_POST["name"]);
    $nameErr = "";
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
    }
    
    // Sanitize and validate email
    $email = test_input($_POST["email"]);
    $emailErr = "";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
    
    // ... Additional validation checks ...

    if ($nameErr != "" || $emailErr != "") {
    echo "<b>Error:</b>";
    echo "<br>" . $nameErr;
    echo "<br>" . $emailErr;
     } else {
    // Proc ess the form data
    echo "Form submitted successfully";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>