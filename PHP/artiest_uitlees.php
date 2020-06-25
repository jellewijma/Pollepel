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
    ?>
    <h2>overzicht</h2>
    <ul>
      <li><a href="albums_uitlees.php">Albums</a></li>
      <li><a href="bands_uitlees.php">Bands</a></li>
      <li><a href="artiest_uitlees.php">Artiest</a></li>
    </ul>
    <?php
    //Als de gebruik allen 'kijk-rechten' heeft
    //    en geen gebruikers mag toevoegen
    if ($_SESSION['Level'] == 0) {
      echo "<p>U heeft geen rechten om deze pagina te bekijken.</p>";
      echo "<p><a href='bands_uitlees.php'>Ga terug</a></p>";
    }
  }
require('config.php');
// Lees alle artiesten uit de tabel
$opdracht = "SELECT * FROM back_artiesten";
// Als de query resultaat oplevert
if ($resultaat = mysqli_query($mysqli, $opdracht)) {
    // Begin met een tabel-tag + instelling van de tabel
    echo "<table  border=1 cellspacing='0' cellpadding='3'>";
    // Zet een 'header' in de tabel
    echo "<tr><th>Naam:</th><th>Instument</th><th>Geboortedatum</th>";
    echo "<th>Geslacht</th><th>Info</th><th>Band</th><th>Wijzig</th><th>Verwijder</th></tr>";
    // Er worden even veel tabellen gemaakt als er artiesten zijn
    while ($artiest = mysqli_fetch_array($resultaat))
    {
        echo "<tr><td>" . $artiest['Naam'] . "</td>";
        echo "<td>" . $artiest['Instrument'] . "</td>";
        echo "<td>" . $artiest['Geboortedatum'] . "</td>";
        echo "<td>" . $artiest['Geslacht'] . "</td>";
        echo "<td>" . $artiest['Info'] . "</td>";
        // Zoek de bant naam er bij het ID:
        $idBand = $artiest['Band'];
        // Haal de naam van de band uit een andere tabel
        $zoekBand = "SELECT Naam FROM back_bands WHERE ID_band = " . $idBand;
        $resultaatBand = mysqli_query($mysqli, $zoekBand);
        $band = mysqli_fetch_array($resultaatBand);
        // Toon de bandnaam in de tabel:
        echo "<td>" . $band['Naam'] . "</td>";
        echo "<td> <a href='artiest_wijzig.php?ID_artiest=" . $artiest['ID_artiest'] . "'>Wijzigen</a></td>";
        echo "<td> <a href='artiest_verwijder.php?ID_artiest=" . $artiest['ID_artiest'] . "'>Verwijder</a></td></tr>";
    }
    // Sluit de tabel af
    echo "</table>";

    echo"<a href='artiest_toevoegen.php'>Artiest toevoegen</a><br>";
}
