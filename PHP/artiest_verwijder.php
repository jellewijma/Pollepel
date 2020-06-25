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
  if ($_SESSION['Level'] == 0 && $_SESSION['Level'] == 1) {
    echo "<p>U heeft geen rechten om deze pagina te bekijken.</p>";
    echo "<p><a href='artiest_uitlees.php'>Ga terug</a></p>";
  }
}
//voeg het bestand config.php toe:
require 'config.php';
$userid = $_GET['ID_artiest'];
//maak de query
$query = "SELECT * FROM `back_artiesten` WHERE ID_artiest = " . $userid;
// haal het uit de url
$resultaat = mysqli_query($mysqli, $query);
if (mysqli_num_rows($resultaat) == 0) {
  echo "<p>Er is geen artiest met de naam '$userid' gevonden.</p>";
}
//alr er wel rijen zijn gevonden:
else {
  $rij = mysqli_fetch_array($resultaat);

  ?>

  <p>Weet je zeker dat je de onderstaande artiest wilt verwijderen?</p>
  <form name="form1" method="post" action="">
    <input type="hidden" name="ID" value="<?php echo $rij['userid'] ?>">
    <table>
      <tr>
        <td><p>Naam:</p></td>
        <td><input type="text" name="Naam" value="<?php echo $rij['Naam'] ?>"></td>
      </tr>
      <tr>
        <td><p>Instrument:</p></td>
        <td><input type="text" name="Instrument" value="<?php echo $rij['Instrument'] ?>"></td>
      </tr>
      <tr>
        <td><p>Gebroortedatum:</p></td>
        <td><input type="text" name="Gebroortedatum" value="<?php echo $rij['Geboortedatum'] ?>"></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="verwijder" name="verwijder"></td>
      </tr>
    </table>
  </form>
  <?php
  if (isset($_POST['verwijder'])) {
    require('config.php');
    //maak de query:
    $opdracht = "DELETE FROM back_artiesten WHERE ID_artiest = $userid";

    if (mysqli_query($mysqli, $opdracht)) {
      echo $rij['Naam'] . " is verwijderd!<br/>";
    } else {
      echo "FOUT bij het aan verwijderen van " . $rij['Naam'] . "!<br/>";
      echo "Query: $opdracht <br/>";
      echo "Foutmelding: " . mysqli_error($mysqli);
    }
  }
}
echo "<p>Terug naar <a href='artiest_uitlees.php'>overzicht</a></p>";
?>