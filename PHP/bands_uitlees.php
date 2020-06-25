
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
}
else {
    echo "<p>Welkom, " . $_SESSION['Gebruikersnaam'] . "</p>";
    ?>
  <h2>overzicht</h2>
  <ul>
      <li><a href="albums_uitlees.php">Albums</a></li>
      <li><a href="bands_uitlees.php">Bands</a></li>
      <li><a href="artiest_uitlees.php">Artiest</a></li>
  </ul>
  <?php
}
//voeg het bestand config.php toe:
require 'config.php';

//maak de query
$query = "SELECT `Naam`,`Muzieksoort`,`ID_band` FROM `back_bands` WHERE 1";

// haal het uit de url
$resultaat = mysqli_query($mysqli, $query);

if (mysqli_num_rows($resultaat) == 0)
{
    echo "<p>We zijn geen resultaten gevonden.</p>";
} 
//alr er wel rijen zijn gevonden:
else
{

    echo "<h1>Alle bands:</h1>";
    //Maak een table (BUITEN DE WHILE LUS!)
    echo "<table border='1'>";
    // via een while worden alle rijen uitgelezen en getoond
    while ($rij = mysqli_fetch_array($resultaat))
    {
        echo "<tr>";
        echo "<td>" . $rij['Naam'] . "</td>";
        echo "<td>" . $rij['Muzieksoort'] . "</td>";
        echo "<td> <a href='band_detail.php?ID_band=" . $rij['ID_band'] . "'>detail</a></td>";
        echo "<td> <a href='band_wijzig.php?ID_band=" . $rij['ID_band'] . "'>Wijzigen</a></td>";
        echo "<td> <a href='band_verwijder.php?ID_band=" . $rij['ID_band'] . "'>verwijder</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<a href='band_toevoegen.php'>band toevoegen</a>";
    echo "<p><a href='uitlog.php'>UITLOGGEN</a></p>";
}
?>
</body>
</html>