<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    //start de session
    session_start();
    //als de gebruiker NIET is ingelogd
    //      dna bestaat de session 'Gebruiker' niet:
    if (!isset($_SESSION['Gebruikersnaam'])) {
        //stuur de gerbuiker direct naar 'inlog.php'
        header("location:inlog.php");
    } else {
        echo "<p>Welkom, " . $_SESSION['Gebruikersnaam'] . "</p>";
    }
    //voeg het bestand config.php toe:
    require 'config.php';

    $userid = $_GET['ID_band'];
    //maak de query
    $query = "SELECT * FROM `back_bands` WHERE ID_band = " . $userid;

    // haal het uit de url
    $resultaat = mysqli_query($mysqli, $query);

    if (mysqli_num_rows($resultaat) == 0) {
        echo "<p>Er is geen band met de naam $userid gevonden.</p>";
    }
    //alr er wel rijen zijn gevonden:
    else {
        $rij = mysqli_fetch_array($resultaat);

        echo "<h2>Gegevens van user met de naam " . $rij['Naam'] . ":</h2>";
        echo "<table border='1' cellspacing='0' cellpadding='3'>";
        echo "<tr><td>Naam:</td>";
        echo "<td>" . $rij['Naam'] . "</td></tr>";
        echo "<tr><td>Land:</td>";
        echo "<td>" . $rij['Land'] . "</td></tr>";
        echo "<tr><td>Aantalleden:</td>";
        echo "<td>" . $rij['AantalLeden'] . "</td></tr>";
        echo "<tr><td>Muzieksoort:</td>";
        echo "<td>" . $rij['Muzieksoort'] . "</td></tr>";
        echo "<tr><td>Info:</td>";
        echo "<td>" . $rij['Info'] . "</td></tr>";
        echo "</table>";
        $zoekLeden = "SELECT * FROM back_artiesten WHERE Band = " . $userid;
        // Query uitvoeren
        $alleLeden = mysqli_query($mysqli, $zoekLeden);
        // gegevens van de bandleden
        echo "<h2>De leden van de band:</h2>";
        echo "<table border='1' cellspacing='0' cellpadding='3'>";
        while($artiest = mysqli_fetch_array($alleLeden)){
            echo "<tr><td>" . $artiest['Naam'] . "</td>";
            echo "<td>" . $artiest['Instrument'] . "</td></tr>";
        }
    }
    echo "<p>Terug naar <a href='bands_uitlees.php'>overzicht</a></p>";
    ?>
</body>

</html>