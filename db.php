<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];

    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $firstname = $_POST["firstname"];

    $lastname = $_POST["lastname"];

    $email = $_POST["email"];

    $role = $_POST["role"];

    $conn = new mysqli("localhost", "root", "", "week5");

    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);

    }

    $sql = "INSERT INTO users (username, password, firstname, lastname, email, role) VALUES ('$username', '$password', '$firstname', '$lastname', '$email', '$role')";

    if ($conn->query($sql) === TRUE) {

        session_start();

        $_SESSION['username'] = $username;

        header("Location: index.php");

    } else {

        echo "Error: " . $sql . "<br>" . $conn->error;

    }    $conn->close();

}

?>