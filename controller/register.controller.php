<?php
/*
TC: We will handle just 3 pseudo procedure here.
1. Registration process
2. Inserts user info into the database and 
3. Sends account confirmation email message
*/

//TC: Set session variables to be used on profile.php page


$_SESSION['email'] = $_POST['email'];
$_SESSION['firstname'] = $_POST['firstname'];
$_SESSION['lastname'] = $_POST['lastname'];

//TC: Escape all $_POST variables to protect against SQL injections
$firstname = $mysqli->escape_string($_POST['firstname']);
$lastname = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$password = $mysqli->escape_string(password_hash($_POST['password'], PASSWORD_BCRYPT));
$hash = $mysqli->escape_string(md5(rand(0, 1000)));

if (strlen($firstname) == 0 || strlen($lastname) == 0 || strlen($email) == 0 || strlen($password) == 0) {
    $_SESSION['message'] = 'Input is not correct!';
    return;
    // header("location: index.php");
}

//TC: Check if user with that email already exists
if (!empty($mysqli->error)) {
    echo $mysqli->error; // <- this is not a function call error()
} else {
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
}


//TC: We know user email exists if the rows returned are more than 0
if ($result->num_rows > 0) {

    $_SESSION['message'] = 'User with this email already exists!';
    return;
    // header("location: index.php");

} else { //TC:  Email doesn't already exist in a database, proceed...

    //TC: active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (firstname, lastname, email, password, hash) "
        . "VALUES ('$firstname','$lastname','$email','$password', '$hash')";    
    //TC: Add user to the database
    if ($mysqli->query($sql)) {

        $_SESSION['active'] = 1; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = 1; // So we know the user has logged in
        $_SESSION['message'] =
            "Great! you're almost done. A confirmation link has been sent to $email,
                  please verify your account by clicking on the link in the message!";

        //TC: Send registration confirmation link (verify.php)
        $to = $email;
        $subject = 'Account Verification (localhost:8080)'; //Name of My own website(Edited)
        $message_body = '
        Hello ' . $firstname . ',

        Thank you for signing up!

        Kindly click this link to activate your account:

        http://localhost/verify.php?email=' . $email . '&hash=' . $hash;

        mail($to, $subject, $message_body, '');
        header("location: /");

    } else {
        $_SESSION['message'] = 'Registration failed!';
        return;
        // header("location: error.php"); //TC: This will  run only if there's an error
    }

}