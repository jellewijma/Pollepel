<?php include('config.php')?>

<html>

<body>
<h2>registreren</h2>

<form name="form1" action="" method="POST" enctype="multipart/form-data">
    <table width="400" border="0">
        <tr>
            <td>Volledigenaam:</td>
            <td><input type="text" id="Naam" name="Naam" value="" required></td>
        </tr>
        <tr>
            <td>Gebruikernaam:</td>
            <td><input type="text" id="Gebruikernaam" name="Gebruikernaam" value="" required></td>
        </tr>
        <tr>
            <td>Geboortedatum:</td>
            <td><input type="date" id="Date" name="Date" value="" required></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" id="Email" name="Email" value="" required></td>
        </tr>
        <tr>
            <td>wachtwoord:</td>
            <td><input type="password" id="Password" name="Password" value="" required></td>
        </tr>
        <tr>
            <td>telefoon nummer:</td>
            <td><input type="text" id="Telefoonnummer" name="Telefoonnummer" value=""></td>
        </tr>
        <tr>
            <td>profiel foto:</td>
            <td><input type="file" id="profielfoto" name="profielfoto" value=""></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="submit" name="submit"></td>
        </tr>
    </table>
  <?php

  if (isset($_POST['submit'])) {
    require('config.php');

    $Naam = $_POST['Naam'];
    $Gebruikernaam = $_POST['Gebruikernaam'];
    $Date = $_POST['Date'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Telefoonnummer = $_POST['Telefoonnummer'];

    // new

    $Afbeelding = $_FILES['profielfoto'];

    $Temp = $Afbeelding['tmp_name'];
    $Name = $Afbeelding['name'];
    $Type = $Afbeelding['type'];
    $Map = "..//Resorce/ProfielFoto/";

    $Toegestaan = array("image/jpeg", "image/gif", "image/png", "image/jpg");

    if (in_array($Type, $Toegestaan)) {
      echo "Verplaats " . $Temp . " naar " . $Map . $Name . "...<br/>";

      if (move_uploaded_file($Temp, $Map.$Name)) {
        echo "Het is gelukt";
      } else {
        echo "Het is niet gelukt";
      }
    } else {
      echo "Dit bestandtype ($Type) is niet toegestaan!<br/>";
    }

    echo $Name;

    //maak de query:
    $opdracht = "INSERT INTO `Beroeps_User` VALUES (NULL, '$Naam', '$Gebruikernaam', '$Date', '$Email', '$Password', '$Telefoonnummer', '$Name', '0')";

    if (mysqli_query($mysqli, $opdracht)) {
      echo "U bent toegevoegd!<br/>";
    } else {
      echo "FOUT bij toevoegen van uw profiel!<br/>";
      echo "Query: $opdracht <br/>";
      echo "Foutmelding: " . mysqli_error($mysqli);
    }


  }
?>
</body>
    <a href="inlog.php">Inloggen</a>
</html>