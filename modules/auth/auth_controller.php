<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include "../../config/database.php";

//---------SIGNUP-------

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = "user";

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Signup successful";
    } else {
        echo "Error: " . $conn->error;
    }

    $user_id = mysqli_insert_id($conn);

    $name  = $_POST['name'];
$email = $_POST['email'];

$alumni_query = "INSERT INTO alumni 
                (user_id, name, email) 
                VALUES ('$user_id', '$name', '$email')";

mysqli_query($conn, $alumni_query);

}

//--------LOGIN-------

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        header("Location: ../../index.php");
        exit();
    }
    else {
        echo "Invaild login";
    }
}
?>