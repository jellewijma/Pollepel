<?php
session_start();
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inlog</title>
</head>

<body>
    <?php

    // als het formulier is verstuurd
    if (isset($_POST['inlog'])) {
        //Voeg de databaseconnectie toe
        require 'config.php';
        //Lees de gegevens uit
        $Gebruikersnaam = $_POST['Gebruikersnaam'];
        $Wachtwoord = $_POST['Wachtwoord'];
        //maar een query
        $opdracht = "SELECT * FROM back_users
                 WHERE Gebruikersnaam = '$Gebruikersnaam'
                 AND Wachtwoord = '$Wachtwoord'";
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
                    <td><input type="submit" name="inlog" value="LOG IN"></td>
                </tr>
            </table>
        </form>
        <p>Inlog gegevens: jelle/wijma</p>
    <?php
    }
    ?>
</body>

</html>