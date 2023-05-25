<link rel="stylesheet" href="../css/main.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
    function goBack() {
        history.back();
        setTimeout(function() {
            location.reload();
        }, 100);
    }
</script>
<?php

$conn = new mysqli("localhost", "root");


if ($conn->connect_error) {
    die("Connection au serveur echouee!");
}
$conn->query("USE USERS");



//Suppression de donnees
$name = $_POST['name'];
$user = $_POST['user'];

$stmt = $conn->prepare("DELETE FROM sites WHERE user_name = '{$user}' AND name = '{$name}'");
$stmt->execute();
echo "Vos données ont été supprimées avec succès! Veuillez rafraichir la page pour voir les modifications\n";
echo "<a onclick='goBack()' class='home-button'><i class='fa fa-home'></i></a>";
$stmt->close();



//Fermeture de connection
$conn->close();

?>