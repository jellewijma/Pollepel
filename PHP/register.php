<?php include('config.php')?>

<html>

<body>
<h2>registreren</h2>

<form name="form1" action="" method="POST">
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
    $profielfoto = $_POST['profielfoto'];

    //maak de query:
    $opdracht = "INSERT INTO `Beroeps_User` VALUES (NULL, '$Naam', '$Gebruikernaam', '$Date', '$Email', '$Password', '$Telefoonnummer', '$profielfoto', '0')";

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