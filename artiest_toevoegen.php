<html>

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
    //Als de gebruik allen 'kijk-rechten' heeft
    //    en geen gebruikers mag toevoegen
    if ($_SESSION['Level'] == 0) {
      echo "<p>U heeft geen rechten om deze pagina te bekijken.</p>";
      echo "<p><a href='bands_uitlees.php'>Ga terug</a></p>";
    }
  }
  ?>
  <h2>Voeg een artiest toe:</h2>

  <form name="form1" action="" method="POST">
    <table width="400" border="0">
      <tr>
        <td>Naam:</td>
        <td><input type="text" id="Naam" name="Naam" value="<?php echo $rij['Naam'] ?>" require></td>
      </tr>
      <tr>
        <td>Instrument:</td>
        <td><input type="text" id="Instrument" name="Instrument" value="<?php echo $rij['Instrument'] ?>" require></td>
      </tr>
      <tr>
        <td>Geboortedatum:</td>
        <td><input type="date" id="Geboortedatum" name="Geboortedatum" value="<?php echo $rij['Geboortedatum'] ?>" require></td>
      </tr>
      <tr>
        <td>Geslacht:</td>
        <td><input type="text" id="Geslacht" name="Geslacht" value="<?php echo $rij['Geslacht'] ?>" require></td>
      </tr>
      <tr>
        <td>Info:</td>
        <td><input type="text" id="Info" name="Info" value="<?php echo $rij['Info'] ?>"></td>
      </tr>
      <tr>
        <td>Band:</td>
        <td>
          <select name="bandveld" id="">
            <?php
            require('config.php');
            $opdracht = "SELECT * FROM back_bands";
            $resultaat = mysqli_query($mysqli, $opdracht);
            while ($band = mysqli_fetch_array($resultaat)) {
              echo '<option value="' . $band["ID_band"] . '">';
              echo $band['Naam'];
              echo '</option>';
            }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="submit" name="submit"></td>
      </tr>
    </table>
  </form>
  <p>&nbsp;</p>
  <?php
  if (isset($_POST['submit'])) {
    require('config.php');

    $Naam = $_POST['Naam'];
    $Instrument = $_POST['Instrument'];
    $Geboortedatum = $_POST['Geboortedatum'];
    $Geslacht = $_POST['Geslacht'];
    $Info = $_POST['Info'];
    $band = $_POST['bandveld'];

    $arr = explode('-', $Geboortedatum);
    // kijk of er iets is ingevuld in de query
    if ($Naam != "" && $Instrument != "" && $band != "" && checkdate($arr[1], $arr[2], $arr[0]) && is_int($band)) {
      //maak de query:
      $opdracht = "INSERT INTO back_artiesten VALUES (NULL, '$Naam', '$Instrument', '$Geboortedatum', '$Geslacht', '$Info', '$band')";
      // geef aan of de opdracht correct is uitgevoerd
      if (mysqli_query($mysqli, $opdracht)) {
        echo "$Naam is toegevoegd!<br/>";
      } else {
        echo "FOUT bij toevoegen $Naam!<br/>";
        echo "Query: $opdracht <br/>";
        echo "Foutmelding: " . mysqli_error($mysqli);
      }
    } else {
      echo '<script language="javascript">';
      echo 'alert("Controleer of alles is goed is ingevuld")';
      echo '</script>';
    }
  }
  echo "<a href='artiest_uitlees.php'>Artiest uitlezen</a>";
  ?>
</body>

</html>