<?php
//start de session
session_start();
//als de gebruiker NIET is ingelogd
//      dna bestaat de session 'Gebruiker' niet:
if (!isset($_SESSION['Gebruikersnaam'])) {
    //stuur de gerbuiker direct naar 'inlog.php'
    header("location:inlog.php");
}
else {
    echo "<p>Welkom, " . $_SESSION['Gebruikersnaam'] . "</p>";
    //Als de gebruik allen 'kijk-rechten' heeft
    //    en geen gebruikers mag toevoegen
    if ($_SESSION['Level'] == 0) {
        echo "<p>U heeft geen rechten om deze pagina te bekijken.</p>";
        echo "<p><a href='bands_uitlees.php'>Ga terug</a></p>";
      }
}
//voeg het bestand config.php toe:
require 'config.php';

$userid = $_GET['ID_band'];
//maak de query
$query = "SELECT * FROM `back_bands` WHERE ID_band = " . $userid;

// haal het uit de url
$resultaat = mysqli_query($mysqli, $query);

if (mysqli_num_rows($resultaat) == 0) {
    echo "<p>Er is geen user met ID $userid gevonden.</p>";
}
//alr er wel rijen zijn gevonden:
else {
    $rij = mysqli_fetch_array($resultaat);
?>
    <form name="form1" action="" method="POST">
        <table width="400" border="0">
            <tr>
                <td>Bandnaam:</td>
                <td><input type="text" id="Bandnaam" name="Bandnaam" value="<?php echo $rij['Naam'] ?>" required></td>
            </tr>
            <tr>
                <td>Land van herkomst:</td>
                <td><input type="text" id="afkomst" name="afkomst" value="<?php echo $rij['Land'] ?>" required></td>
            </tr>
            <tr>
                <td>Aantal leden:</td>
                <td><input type="number" id="leden" name="leden" value="<?php echo $rij['AantalLeden'] ?>" required></td>
            </tr>
            <tr>
                <td>Soort muziek:</td>
                <td><input type="text" id="muziek" name="muziek" value="<?php echo $rij['Muzieksoort'] ?>" required></td>
            </tr>
            <tr>
                <td>Algemene info:</td>
                <td><input type="textbox" id="Algemene" name="Algemene" value="<?php echo $rij['Info'] ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="submit" name="Wijzig"></td>
            </tr>
        </table>
    <?php

    if (isset($_POST['Wijzig'])) {
        require('config.php');

        $Bandnaam = $_POST['Bandnaam'];
        $afkomst = $_POST['afkomst'];
        $leden = $_POST['leden'];
        $muziek = $_POST['muziek'];
        $Algemene = $_POST['Algemene'];

        //maak de query:
        $opdracht = "UPDATE back_bands 
                     SET Naam = '$Bandnaam', Land = '$afkomst', AantalLeden = '$leden', Muzieksoort = '$muziek', Info = '$Algemene'
                     WHERE ID_band = $userid";

        if (mysqli_query($mysqli, $opdracht)) {
            echo "$Bandnaam is aangepast!<br/>";
        } else {
            echo "FOUT bij het aan passen van $Bandnaam!<br/>";
            echo "Query: $opdracht <br/>";
            echo "Foutmelding: " . mysqli_error($mysqli);
        }
    } else {
        echo "<p>Geen gegevens ontvangen...</p>";
    }
}
echo "<p>Terug naar <a href='bands_uitlees.php'>overzicht</a></p>";
    ?>