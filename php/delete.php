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
    die("Connection au serveur échouée!");
}
$conn->query("USE USERS");

$action = $_POST['delete'];
$user = $_POST['username'];

if ($action === 'all') {
    $stmt = $conn->prepare("DELETE FROM sites WHERE user_name = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    echo "Toutes vos données ont été supprimées avec succès! Veuillez rafraîchir la page pour voir les modifications\n";
    echo "<a onclick='goBack()' class='home-button'><i class='fa fa-home'></i></a>";
    $stmt->close();
} elseif ($action === 'acc') {
    $stmt = $conn->prepare("DELETE FROM sites WHERE user_name = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare("DELETE FROM login WHERE user_name = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    echo "Toutes vos données et votre compte ont été supprimés avec succès!\n";
    echo "<a href='../' class='home-button'><i class='fa fa-home'></i></a>";
    $stmt->close();
}

// Fermeture de la connexion
$conn->close();
?>
