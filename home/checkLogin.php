<?php

$conn = new mysqli("localhost", "root");


if ($conn->connect_error) {
    die("Connection au serveur echouee!");
}


$conn->query("USE USERS");




$name = $_POST['uname'];
$password = $_POST['psw'];

if (!empty($name) && !empty($password)) {
    $stmt = $conn->prepare("SELECT * FROM login WHERE user_name = ? AND password = ?");
    $stmt->bind_param("ss", $name, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        echo "Login réussi!";
        session_start();
        $_SESSION['username'] = $name;
        header("Location: ./");
        exit();
    }
    else {
        echo "Nom d'utilisateur ou mot de passe invalide!";
    }

    $stmt->close();
}



else {
    echo "Erreur: Nom d'utilisateur ou mot de passe vide!";
}


$conn->close();

?>