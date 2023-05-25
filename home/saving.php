<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
    function goBack() {
        window.history.back();
    }
</script>
<?php

$conn = new mysqli("localhost", "root");


if ($conn->connect_error) {
    die("Connection au serveur echouee!");
}
$conn->query("USE USERS");

function generatePassword($length, $useUppercase, $useNumbers, $useSymbols) {
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $symbols = '!@#$%^&*()-_+=[]{}|;:,.<>?';

    $charset = $lowercase;
    if($useUppercase) {
        $charset .= $uppercase;
    }
    if($useNumbers) {
        $charset .= $numbers;
    }
    if($useSymbols) {
        $charset .= $symbols;
    }

    $password = '';
    $charsetLength = strlen($charset);
    for ($i=0; $i<$length; $i++) {
        $password .= $charset[random_int(0, $charsetLength - 1)];
    }
    return $password;
}


//Insertion de donnees
$name = $_POST['nom'];
$password = generatePassword($_POST['longueur'], isset($_POST['majuscules']), isset($_POST['chiffres']), isset($_POST['symboles']));
$user = $_POST['username'];

if (!empty($name) && !empty($password)) {
    $stmt = $conn->prepare("INSERT INTO sites (name, password, user_name) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $password, $user);
    $stmt->execute();
    echo "Vos données ont été insérées avec succès!\n";
    echo "<a onclick='goBack()' class='home-button'><i class='fa fa-home'></i></a>";
    $stmt->close();
} else {
    echo "Erreur: Nom du site ou mot de passe est vide!";
}



//Fermeture de connection
$conn->close();

?>