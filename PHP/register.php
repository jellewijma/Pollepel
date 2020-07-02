<?php include('config.php')?>

<html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Stylish&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..//CSS/registreer.css">
    <script src="../JS/JS.js"></script>
    <title>Registratie</title>
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
            <a class="test" href="recepte_maken.php" onclick="setTimeout(closeNav, 800)"
            >Recepten maken</a
            >
        </li>
        <li>
            <a class="test" href="mijn_recepten.php" onclick="setTimeout(closeNav, 800)"
            >Mijn recepten</a
            >
        </li>
    </ul>
</div>

<h1>registreren</h1>

<form name="form1" action="" method="POST" enctype="multipart/form-data">
    <div class="wrapper">
        <h2>Melden gratis aan</h2>
        <div class="naam">
            <input type="text" id="Naam" name="Naam" placeholder="volledige naam" required>
            <input type="text" id="Gebruikernaam" name="Gebruikernaam" placeholder="Gebruikersnaam" required>
        </div>
        <div class="gegevens">
            <input type="email" id="Email" name="Email" placeholder="Email" required>
            <input type="Pasword" id="Password" name="Password" placeholder="Wachtwoord"  required>
        </div>
        <div class="info">
            <input type="date" id="Date" name="Date" placeholder="Geboortedatum" required>
            <input type="text" id="Telefoonnummer" name="Telefoonnummer" placeholder="Telefoon nummer">
        </div>
        <div class="file">
            <input class="inputfile" type="file" id="profielfoto" name="profielfoto" value="">
            <input type="submit" value="submit" name="submit">
        </div>
    </div>
</form>
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

    //maak de query:
    $opdracht = "INSERT INTO `Beroeps_User` VALUES (NULL, '$Naam', '$Gebruikernaam', '$Date', '$Email', '$Password', '$Telefoonnummer', '$Name', '0')";

    if (mysqli_query($mysqli, $opdracht)) {
      echo "U bent toegevoegd!<br/>";
      header("Location: inlog.php");
      exit;
    } else {
      echo "FOUT bij toevoegen van uw profiel!<br/>";
      echo "Query: $opdracht <br/>";
      echo "Foutmelding: " . mysqli_error($mysqli);
    }


  }
?>
</body>

</html>