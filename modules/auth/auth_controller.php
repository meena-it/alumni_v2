<?php

include "../../config/database.php";

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', 'user')";

    if ($conn->query($sql) === TRUE) {
        echo "Signup successful";
    } else {
        echo "Error: " . $conn->error;
    }
}
