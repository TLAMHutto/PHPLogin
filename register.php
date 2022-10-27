<!DOCTYPE html>
<?php
function sanitizeFormUsername($inputText) {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    return $inputText;
}
function sanitizeFormString($inputText) {
    $inputText = strip_tags($inputText);
    $inputText = str_replace(" ", "", $inputText);
    $inputText = ucfirst(strtolower($inputText));
    return $inputText;
}
function sanitizeFormPassword($inputText) {
    $inputText = strip_tags($inputText);
    return $inputText;
}

if (isset($_POST['loginButton'])) {
    echo "Login button was pressed";
} 
if (isset($_POST['registerButton'])) {
    $username = sanitizeFormUsername($_POST['username']);
    $firstName = sanitizeFormString($_POST['firstName']);
    $lastName = sanitizeFormString($_POST['lastName']);
    $email = sanitizeFormUsername($_POST['email']);
    $email2 = sanitizeFormUsername($_POST['email2']);
    $password = sanitizeFormPassword($_POST['password']);
    $password2 = sanitizeFormPassword($_POST['password2']);
    
    $wasSuccessful = $account->register($username, $firstName, $lastName, $email, $email2, $password, $password2);
    if ($wasSuccessful) {
        $_SESSION['userLoggedIn'] = $username;
        header("Location: index.php");
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div id='inputContainer'>
        <form action="register.php" id="loginForm" method='POST'>
            <h2>Login to your account</h2>
            <p>
                <label for="loginUsername">Username</label>
                <input type="text" id="loginUsername" name='loginUsername' required>
            </p>
            <p>
                <label for="loginPassword">Password</label>
                <input type="password" id="loginPassword" name='loginPassword' required>
            </p>
            <button type='submit' name='loginButton'>LOG IN</button>
        </form>
        <form action="register.php" id="registerForm" method='POST'>
            <h2>Create your free account</h2>
            <p>
                <label for="username">Username</label>
                <input type="text" id="username" name='username' required>
            </p>
            <p>
                <label for="firstName">First name</label>
                <input type="text" id="firstName" name='firstName' required>
            </p>
            <p>
                <label for="lastName">Last name</label>
                <input type="text" id="lastName" name='lastName' required>
            </p>
            <p>
                <label for="email">Email</label>
                <input type="email" id="email" name='email' required>
            </p>
            <p>
                <label for="email2">Confirm email</label>
                <input type="email" id="email2" name='email2' required>
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" id="password" name='password' required>
            </p>
            <p>
                <label for="password2">Confirm password</label>
                <input type="password" id="password2" name='password2' required>
            </p>
            <button type='submit' name='registerButton'>SIGN UP</button>
    </div>
</body>
</html>