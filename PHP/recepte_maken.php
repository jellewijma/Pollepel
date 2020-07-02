<?php
include('config.php');
//start de session
session_start();
//als de gebruiker NIET is ingelogd
//      dna bestaat de session 'Gebruiker' niet:
if (!isset($_SESSION['Gebruikersnaam'])) {
  //stuur de gerbuiker direct naar 'inlog.php'
  header("location:index.php");
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../CSS/Style.css"/>
  <script src="../JS/JS.js"></script>
</head>
<body>
<div class="Menu">
  <!-- Menu Button -->
  <span onclick="openNav()" class="spanButton">&#9776;</span>

  <!-- Menu -->
  <ul id="mySidenav" class="sidenav">
    <li>
      <a
        class="test"
        href="javascript:void(0)"
        class="closebtn"
        onclick="closeNav()"
      >&times;</a
      >
    </li>
    <li>
      <a
        class="test"
        href="index.php"
        onclick="setTimeout(closeNav, 800)"
      >home</a
      >
    </li>
    <li>
      <a class="test" href="mijn_recepten.php" onclick="setTimeout(closeNav, 800)"
      >Mijn recepten</a
      >
    </li>
    <li>
      <a class="test" href="recepte_maken.php" onclick="setTimeout(closeNav, 800)"
      >Recepten maken</a
      >
    </li>
  </ul>
</div>

<h2>Recept toevoegen</h2>

<form name="form1" action="" method="POST" enctype="multipart/form-data">
  <table width="400" border="0">
    <tr>
      <td>Title recept:</td>
      <td><input type="text" id="Title" name="Title" value="" required></td>
    </tr>
      <tr>
          <td>Recept foto:</td>
          <td><input type="file" id="Image" name="Image" value=""></td>
      </tr>
    <tr>
      <td>Caterogy:</td>
      <td><input type="text" id="Caterogy" name="Caterogy" value="" required></td>
    </tr>
    <tr>
      <td>Text:</td>
      <td><textarea rows="4" cols="50" name="Text"></textarea>
    </tr>
    <tr>
      <td></td>
      <td><input type="submit" value="submit" name="submit"></td>
    </tr>
  </table>
  <a href='mijn_recepten.php'>Naar Mijn recepten</a>
  <?php

  if (isset($_POST['submit'])) {
    require('config.php');

    $Title = $_POST['Title'];
    $Caterogy = $_POST['Caterogy'];
    $Text = $_POST['Text'];

    $Image = $_FILES['Image'];
    $Temp = $Image['tmp_name'];
    $Name = $Image['name'];
    $Type = $Image['type'];
    $Map = "..//Resorce/ReceptFoto/";

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

    //maak de query:
    $opdracht = "INSERT INTO Beroeps_Recept VALUES (NULL,'$Name', '$Title', '$Text', '$Caterogy')";


    if (mysqli_query($mysqli, $opdracht)) {
      echo "Uw recept is toegevoegd!<br/>";
    } else {
      echo "FOUT bij toevoegen van uw recept <br/>";
      echo "Query: $opdracht <br/>";
      echo "Foutmelding: " . mysqli_error($mysqli);
    }
    $zoekUserId = $_SESSION['User_ID'];
    $zoekReceptId = "select Recept_ID from Beroeps_Recept order by Recept_ID desc limit 1";
    $resultaat = mysqli_query($mysqli, $zoekReceptId);
    $rij = mysqli_fetch_array($resultaat);
    $antwoord = "INSERT INTO Beroeps_Kopeling VALUES ('$zoekUserId', '$rij[0]')";
    if (mysqli_query($mysqli, $antwoord)) {
      echo "Uw kopeling is toegevoegd!<br/>";
    } else {
      echo "FOUT bij koppelen van uw recept <br/>";
      echo "Query: $opdracht <br/>";
      echo "Foutmelding: " . mysqli_error($mysqli);
    }
  }
  ?>

</body>
</html>
