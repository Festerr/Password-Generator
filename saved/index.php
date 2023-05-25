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
<body>	
    <h1>Mots de passe enregistrés</h1>


        <?php

        $conn = new mysqli("localhost", "root");


        if ($conn->connect_error) {
            die("Connection au serveur echouee!");
        }

        $conn->query("USE USERS");

        $username = $_POST['uname'];
        
        //Affichage
        $sql = "SELECT name, password, user_name FROM sites WHERE user_name = '$username'";
        $result = $conn->query($sql);

        $username = '';

        if($result->num_rows > 0){
            echo "<table>\n
                <tr>\n
                    <td>Site</td>\n
                    <td>Mot de passe</td>\n
                </tr>\n";
            while($row = $result->fetch_assoc()){
                $username = $row['user_name'];
                echo "<tr>
                <td>" . $row['name'] ."</td>\n
                <td>
                    <div class='password-container'>
                        <span class='password'>&#9679;&#9679;&#9679;&#9679;&#9679;</span>
                        <i class='fa fa-eye password-toggle'></i>
                        <i class='fa fa-copy password-copy'>
                        </i><span class='password-text hide'>" . $row['password'] . "</span>
                        <form method='post' action='delete.php' class='delete-form'>
                            <input type='hidden' name='name' value='" . $row['name'] . "'>
                            <input type='hidden' name='user' value='" . $row['user_name'] . "'>
                            <button type='submit' class='delete-password'><i class='fa fa-trash'></i></button>
                        </form>
                    </div>
                </td>\n
                 </tr>\n";
                }
            echo "</table>\n";
            echo "<div class='download'><form method='post' action='download.php'>
                    <input type='hidden' name='user' value='" . $username . "'>
                    <label>Téléchargez les mots de passe </label>
                    <button type='submit' <i class='fa fa-download'></i></button>
                </form></div>";
        }
        else{
            echo "0 resultats";
        }

        //Fermeture de connection
        $conn->close();

        ?>
        <a onclick="goBack()" class="home-button"><i class="fa fa-home"></i></a>
        <a class="logout" href="../"><i class="fa fa-sign-out"></i></a>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const passwordToggles = document.querySelectorAll('.password-toggle');

        passwordToggles.forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const passwordContainer = this.parentElement;
                const passwordText = passwordContainer.querySelector('.password-text');
                const passwordDots = passwordContainer.querySelector('.password');

                if (passwordText.classList.contains('hide')) {
                    passwordText.classList.remove('hide');
                    passwordDots.classList.add('hide');
                    this.textContent = '';
                } else {
                    passwordText.classList.add('hide');
                    passwordDots.classList.remove('hide');
                    this.textContent = '';
                }
            });
        });

    });
    document.addEventListener('DOMContentLoaded', function() {
        const passwordCopies = document.querySelectorAll('.password-copy');

        passwordCopies.forEach(function(copy) {
            copy.addEventListener('click', function() {
                const passwordText = this.parentElement.querySelector('.password-text');
                navigator.clipboard.writeText(passwordText.textContent).then(function() {
                    console.log('Password copied to clipboard');
                }).catch(function(err) {
                    console.error('Could not copy password: ', err);
                });
            });
        });
    });

    function goBack() {
        window.history.back();
    }
    document.addEventListener('DOMContentLoaded', function() {
        var toggle = document.getElementById('settings-toggle');
        var menu = document.getElementById('settings-menu');

        toggle.addEventListener('click', function() {
            if (menu.style.display === 'block') {
            menu.style.display = 'none';
            } else {
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