<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Générateur de mots de passe</title>
</head>

<?php

    session_start();

    if (!isset($_SESSION['username'])) {
        header("Location: ../");
        exit();
    }

    $username = $_SESSION['username'];

    echo "Bienvenue, " . $username . "!";
?>


<body>
	<div class="settings-dropdown">
	<i class="fa fa-cog" id="settings-toggle"></i>
	<div class="settings-menu" id="settings-menu">
    <form action="../php/delete.php" method="POST">
	  <ul>
        <li><a href="../">Logout</a></li>
        <input type="hidden" name="username" value="<?php echo $username?>">
        <li><button type="submit" name="delete" value="all" class="borderless-button">Supprimer tous les données</button></li>
        <li><button type="submit" name="delete" value="acc" class="borderless-button">Supprimer le compte</button></li>
      </ul>
    </form>
  </div>
	</div>
    <h1>Générateur de mots de passe</h1><br><br>

	<form action="saving.php" method="post">
		<label for="nom">Nom/adresse du site :</label>
		<input type="text" id="nom" name="nom">
        <br><br>
		<label for="longueur">Longueur du mot de passe (8, 12 ou 16) :</label>
		<select id="longueur" name="longueur">
			<option value="8">8</option>
			<option value="12">12</option>
			<option value="16">16</option>
		</select>
		<br><br>
		<label for="majuscules">Majuscules :</label>
		<input type="checkbox" id="majuscules" name="majuscules">
		<br><br>
		<label for="chiffres">Chiffres :</label>
		<input type="checkbox" id="chiffres" name="chiffres">
		<br><br>
		<label for="symboles">Symboles :</label>
		<input type="checkbox" id="symboles" name="symboles">
		<br><br>
        <input type="hidden" name="username" value="<?php echo $username?>">
		<input type="submit" value="Générer">
	</form>

    <br><br>
	<form action="../saved/" method="post">
    	<input type="hidden" name="uname" value="<?php echo $username?>">
    	<input type="submit" value="Mots de passe enregistrés">
	</form>

	<script>
    
	  document.addEventListener('DOMContentLoaded', function() {
      var toggle = document.getElementById('settings-toggle');
      var menu = document.getElementById('settings-menu');

      toggle.addEventListener('click', function() {
        if (menu.style.display === 'block') {
          menu.style.display = 'none';
        }
        else {
          menu.style.display = 'block';
        }
      });

      document.addEventListener('click', function(event) {
        var targetElement = event.target;
        if (!menu.contains(targetElement) && targetElement !== toggle) {
          menu.style.display = 'none';
        }
      });
    });

	</script>

</body>
</html>