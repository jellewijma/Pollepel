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
  //Als de gebruik allen 'kijk-rechten' heeft
  //    en geen gebruikers mag toevoegen
  if ($_SESSION['Level'] == 0) {
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
  echo "<p>Er is geen user met ID $userid gevonden.</p>";
}
//alr er wel rijen zijn gevonden:
else {
  $rij = mysqli_fetch_array($resultaat);
?>
  <form name="form1" action="" method="POST">
    <table width="400" border="0">
      <tr>
        <td>Artiest:</td>
        <td><input type="text" id="Naam" name="Naam" value="<?php echo $rij['Naam'] ?>" required></td>
      </tr>
      <tr>
        <td>Instrument:</td>
        <td><input type="text" id="Instrument" name="Instrument" value="<?php echo $rij['Instrument'] ?>" required></td>
      </tr>
      <tr>
        <td>Geboortedatum:</td>
        <td><input type="date" id="Geboortedatum" name="Geboortedatum" value="<?php echo $rij['Geboortedatum'] ?>" required></td>
      </tr>
      <tr>
        <td>Geslacht:</td>
        <td>
          <label for="Man">Man</label>
          <input type="radio" name="Geslacht" value="Man" <?php if ($rij['Geslacht'] == "M") {
                                                            echo "checked";
                                                          } ?>>
          <br>
          <label for="Vrouw">Vrouw</label>
          <input type="radio" name="Geslacht" value="Vrouw" <?php if ($rij['Geslacht'] == "V") {
                                                              echo "checked";
                                                            } ?>>
      </tr>
      <tr>
        <td>Info:</td>
        <td><textarea type="textbox" id="Info" name="Info" value="<?php echo $rij['Info'] ?>" required></textarea></td>
      </tr>
      <tr>
        <td>Band:</td>
        <td>
          <select name="bandveld">
            <?php
            require('config.php');
            $query = "SELECT * FROM `back_artiesten` WHERE ID_artiest = " . $userid;
            $opdracht = "SELECT * FROM back_bands";
            $resultaat = mysqli_query($mysqli, $opdracht);
            $resultaat2 = mysqli_query($mysqli, $query);
            $rij = mysqli_fetch_array($resultaat2);
            while ($band = mysqli_fetch_array($resultaat)) {
              var_dump($rij);
              var_dump($band);
              $correct = "";
              if ($band['ID_band'] == $rij['Band']) {
                $correct = "selected";
              }
              echo '<option value="' . $band["ID_band"] . '"' . $correct .'>';
              echo $band['Naam'];
              echo '</option>';
            }
            ?>
          </select>
        </td>
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
echo "<p>Terug naar <a href='artiest_uitlees.php'>overzicht</a></p>";
  ?>