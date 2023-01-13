<?php
$_SESSION['email'] = $_POST['email'];
$_SESSION['firstname'] = $_POST['firstname'];
$_SESSION['lastname'] = $_POST['lastname'];

$firstname = $mysqli->escape_string($_POST['firstname']);
$lastname = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string(md5(rand(0, 1000)));

if (strlen($firstname) == 0 || strlen($lastname) == 0 || strlen($email) == 0 || strlen($password) == 0) {
    $_SESSION['message'] = 'Input is not correct!';
    return;
}
if (!empty($mysqli->error)) {
    echo $mysqli->error; // <- this is not a function call error()
} else {
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
}
if ($result->num_rows > 0) {

    $_SESSION['message'] = 'User with this email already exists!';
    return;
} else { 
    $sql = "INSERT INTO users (firstname, lastname, email, password, hash) "
        . "VALUES ('$firstname','$lastname','$email','$password', '$hash')";
    if ($mysqli->query($sql)) {

        $_SESSION['active'] = 1;
        $_SESSION['logged_in'] = 1;
        $_SESSION['message'] =
            "Great! you're almost done. A confirmation link has been sent to $email,
                  please verify your account by clicking on the link in the message!";
        $to = $email;
        $subject = 'Account Verification (localhost:8080)';
        $message_body = '
        Hello ' . $firstname . ',

        Thank you for signing up!

        Kindly click this link to activate your account:

        https://therealmofnothing.com/verify.php?email=' . $email . '&hash=' . $hash;

        mail($to, $subject, $message_body, '');
        header("location: /");

    } else {
        $_SESSION['message'] = 'Registration failed!';
        return;
    }

}