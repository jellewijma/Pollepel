<?php
//start de session
session_start();
//als de gebruiker NIET is ingelogd
//      dna bestaat de session 'Gebruiker' niet:
if (!isset($_SESSION['Gebruikersnaam'])) {
  //stuur de gerbuiker direct naar 'inlog.php'
  header("location:inlog.php");
}
//voeg het bestand config.php toe:
require 'config.php';

$recept = $_GET['Recept_ID'];
//maak de query
$query = "SELECT * FROM `Beroeps_Recept` WHERE Recept_ID = " . $recept;

// haal het uit de url
$resultaat = mysqli_query($mysqli, $query);

if (mysqli_num_rows($resultaat) == 0) {
  echo "<p>Er is geen user met ID $recept gevonden.</p>";
}
//alr er wel rijen zijn gevonden:
else {
  $rij = mysqli_fetch_array($resultaat);
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
    <link href="https://fonts.googleapis.com/css2?family=Stylish&display=swap" rel="stylesheet">
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
      <a class="test" href="recepten_aanpassen.php" onclick="setTimeout(closeNav, 800)"
      >Recepten editen</a
      >
    </li>

    <li>
      <a
        class="test"
        href="#WebDevelopment"
        onclick="setTimeout(closeNav, 800)"
      >Web Development</a
      >
    </li>
    <li><a class="test" href="moreInfo.html">More Info</a></li>
  </ul>
</div>


<h2>Recept aanpassen</h2>
<form name="form1" action="" method="POST">
    <table width="400" border="0">
        <tr>
            <td>Title recept:</td>
            <td><input type="text" id="Title" name="Title" value="<?php echo $rij['Title'] ?>" required></td>
        </tr>
        <tr>
            <td>Recept foto:</td>
            <td><input type="file" id="Image" name="Image" value=""></td>
        </tr>
        <tr>
            <td>Caterogy:</td>
            <td><input type="text" id="Caterogy" name="Caterogy" value="<?php echo $rij['Category'] ?>" required></td>
        </tr>
        <tr>
            <td>Text:</td>
            <td><textarea rows="4" cols="50" name="Text"><?php echo $rij['Text'] ?></textarea>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Wijzig" name="Wijzig"></td>
        </tr>
    </table>
    <a href='mijn_recepten.php'>Naar Mijn recepten</a>




  <?php

  if (isset($_POST['Wijzig'])) {
    require('config.php');

    $Title = $_POST['Title'];
    $img = $_POST['Image'];
    $Caterogy = $_POST['Caterogy'];
    $Text = $_POST['Text'];

    //maak de query:
    $opdracht = "UPDATE Beroeps_Recept
                     SET Image = '$img', Title = '$Title', Text = '$Text', Category = '$Caterogy'
                     WHERE Recept_ID = '$recept'";

    if (mysqli_query($mysqli, $opdracht)) {
      echo $rij['Title'] . "is aangepast!<br/>";
    } else {
      echo "FOUT bij het aan passen van" . $rij['Title'] . "!<br/>";
      echo "Query: $opdracht <br/>";
      echo "Foutmelding: " . mysqli_error($mysqli);
    }
  } else {
    echo "<p>Geen gegevens ontvangen...</p>";
  }
  }
  echo "<p>Terug naar <a href='mijn_recepten.php'>overzicht</a></p>";
  ?>
</body>
</html>