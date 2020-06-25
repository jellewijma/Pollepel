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
  <h2>Voeg een band toe:</h2>

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
        <td><input type="textbox" id="Algemene" name="Algemene" value="<?php echo $rij['Info'] ?>"></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="submit" value="submit" name="submit"></td>
      </tr>
    </table>
    <a href='bands_uitlees.php'>Naar band lijst</a>
    <p>&nbsp;</p>
    <?php

    if (isset($_POST['submit'])) {
      require('config.php');

      $Bandnaam = $_POST['Bandnaam'];
      $afkomst = $_POST['afkomst'];
      $leden = $_POST['leden'];
      $muziek = $_POST['muziek'];
      $Algemene = $_POST['Algemene'];

      //maak de query:
      $opdracht = "INSERT INTO back_bands VALUES (NULL, '$Bandnaam', '$afkomst', '$leden', '$muziek', '$Algemene')";

      if (mysqli_query($mysqli, $opdracht)) {
        echo "$Bandnaam is toegevoegd!<br/>";
      } else {
        echo "FOUT bij toevoegen $Bandnaam!<br/>";
        echo "Query: $opdracht <br/>";
        echo "Foutmelding: " . mysqli_error($mysqli);
      }
    }

    ?>
</body>

</html>