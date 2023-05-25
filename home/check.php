<?php

$conn = new mysqli("localhost", "root");


if ($conn->connect_error) {
    die("Connection au serveur echouee!");
}

//Creation de base de donnee
$db = $conn->query("SHOW DATABASES LIKE 'USERS'");

if ($db->num_rows == 0) {
    $conn->query("CREATE DATABASE USERS");
}
$conn->query("USE USERS");

//Creation de table
$table = $conn->query("SHOW TABLES LIKE 'login'");

if ($table->num_rows == 0) {
    $conn->query("CREATE TABLE `login` (
        `user_name` varchar(20) NOT NULL,
        `password` varchar(20) COLLATE utf8mb4_bin,
        PRIMARY KEY (`user_name`)
      );");
}

$table2 = $conn->query("SHOW TABLES LIKE 'sites'");

if ($table->num_rows == 0) {
    $conn->query("CREATE TABLE `sites` (
        `name` varchar(20) NOT NULL,
        `password` varchar(20) NOT NULL,
        `user_name` varchar(20) NOT NULL,
        UNIQUE KEY `unique_site_name_per_user` (`name`,`user_name`),
        KEY `sites_ibfk_1` (`user_name`),
        CONSTRAINT `sites_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `login` (`user_name`)
      );");
}

//Insertion de donnees
$name = $_POST['uname'];
$password = $_POST['psw'];

if (!empty($name) && !empty($password)) {
    $stmt = $conn->prepare("INSERT INTO login (user_name, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $password);
    $stmt->execute();
    echo "Vos données ont été insérées avec succès!\nVous pouvez vous connecter maintenant.\n";
    echo "<a href='../' >Back to login</a>";
    $stmt->close();
}
else {
    echo "Erreur: Nom ou prenom est vide!";
}

//Fermeture de connection
$conn->close();

?>