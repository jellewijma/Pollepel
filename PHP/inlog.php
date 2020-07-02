<?php
session_start();
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/beroeps/CSS/Style.css">
    <title>Inlog</title>
</head>
<body>
	
	<div id="header"><h2>Japan</h2>
     
    </div>
 
    <div id="wrapper">
    <div id="content">
        <h2>LOG IN:</h2>
        <p></p>
        <form method="post" action="">
            <table border="0">
                <tr>
                    <td>Gebruikernaam</td>
                    <td><input type="text" name="Gebruikersnaam" id=""></td>
                </tr>
                <tr>
                    <td>wachtwoord</td>
                    <td><input type="password" name="Wachtwoord" id=""></td>
                </tr>
                <tr>
                    <td>&nbsp</td>
                    <td><input type="submit" name="inlog" value="LOG IN" class="button"></td>
                </tr>
            </table>
        </form>
        <p>Inlog gegevens: jelle/wijma</p><br>
        <p>Nog geen gebruiker?</p>
        <a href="register.php" class="button">registreer</a>
		
    <style>
	
.button {
  border: none;
  padding: 10px 22px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 4px 2px;
  cursor:pointer;
  background-color: #e7e7e7; 
  color: black;
}

	
	</style>
      
        
    </div>
    </div>
    <div id="footer"><h2>Footer</h2>
	
    <?php

    // als het formulier is verstuurd
    if (isset($_POST['inlog'])) {
        //Voeg de databaseconnectie toe
        require 'config.php';
        //Lees de gegevens uit
        $Gebruikersnaam = $_POST['Gebruikersnaam'];
        $Wachtwoord = $_POST['Wachtwoord'];
        //maar een query
        $opdracht = "SELECT * FROM Beroeps-Users
                 WHERE UserName = '$Gebruikersnaam'
                 AND Password = '$Wachtwoord'";
        //Voer de query uit en vang het resultaat op
        $resultaat = mysqli_query($mysqli, $opdracht);
        //controleer of het resultaat een rij (user) heeft opgeleverd
        if (mysqli_num_rows($resultaat) > 0) {

            //haal de user uit het resultaat
            $user = mysqli_fetch_array($resultaat);
            //Zet de gebruikersnaam en level in 2 verschillende sessions
            $_SESSION['Gebruikersnaam'] = $user['Gebruikersnaam'];
            $_SESSION['Level'] = $user['Level'];
            //geef een melding
            echo "<p>hallo $Gebruikersnaam, u bent ingelogd!</p>";
            echo "<p><a href='bands_uitlees.php'>Ga naar band lijst</p>";
            echo "<p><a href='artiest_uitlees.php'>Ga naar artiest lijst</p>";
        } else {
            echo "<p>Naam en/of wachtwoord zijn onjuist.</p>";
            echo "<p><a href='inlog.php'>Probeer opnieuw</p>";
        }
    } else {
    ?>
		</div>
    <?php
    }
    ?>
</body>

</html>