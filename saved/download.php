<?php
$conn = new mysqli("localhost", "root");

if ($conn->connect_error) {
    die("Connection to server failed!");
}

$conn->query("USE USERS");

$user = $_POST['user'];

$sql = "SELECT name, password FROM sites WHERE user_name = '$user'";
$result = mysqli_query($conn, $sql);

$data = "";
while ($row = mysqli_fetch_assoc($result)) {
    $data .= $row['name'] . ": " . $row['password'] . "\n";
}

header('Content-type: text/plain');
header('Content-Disposition: attachment; filename="passwords.txt"');

echo $data;

$conn->close();
?>
