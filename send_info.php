<?php
session_start();
    $output_message = null;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('connect.php');
    $myusername = mysqli_real_escape_string($con, $_POST['username']);//Collecting inputs
    $mypassword = mysqli_real_escape_string($con, $_POST['password']);

    $hashpass = hash("sha256", $mypassword);//Hashing password

    $sql = "SELECT UserName FROM user WHERE UserName = '$myusername' and Password = '$hashpass'"; //Query checks if the username-password combo
                                                                                                  //is in database.
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if ($count == 1){//If there is a user, then create a session.
        $_SESSION['login_user'] = $myusername;
    } else {
        $output_message = "Your login name or password is invalid"; //Else echo an error
        echo $output_message;
    }
    }
?>
