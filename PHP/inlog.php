<?php
session_start();
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Stylish&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..//CSS/inlog.css">
    <script src="../JS/JS.js"></script>
    <title>Inlog</title>
</head>

<body>
<?php

// als het formulier is verstuurd
if (isset($_POST['inlog'])) {
  //Voeg de databaseconnectie toe
  require 'config.php';
  //Lees de gegevens uit
  $Gebruikersnaam = $_POST['Gebruikersnaam'];
  $Wachtwoord = $_POST['Wachtwoord'];
  //$Wachtwoord = sha1($_POST['Wachtwoord']);
  //maar een query
  $opdracht = "SELECT * FROM Beroeps_User
                 WHERE UserName = '$Gebruikersnaam'
                 AND Wachtwoord = '$Wachtwoord'";
  //Voer de query uit en vang het resultaat op
  $resultaat = mysqli_query($mysqli, $opdracht);
  //controleer of het resultaat een rij (user) heeft opgeleverd
  if (mysqli_num_rows($resultaat) > 0) {

    //haal de user uit het resultaat
    $user = mysqli_fetch_array($resultaat);
    //Zet de gebruikersnaam en level in 2 verschillende sessions
    $_SESSION['Gebruikersnaam'] = $user['UserName'];
    $_SESSION['Level'] = $user['Level'];
    $_SESSION['User_ID'] = $user['User_ID'];
    header("Location: index.php");
    exit;
  } else {
    echo "<p>Naam en/of wachtwoord zijn onjuist.</p>";
    echo "<p><a href='inlog.php'>Probeer opnieuw</p>";
  }
} else {
  ?>
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
    <h1>LOG IN:</h1>
    <form method="post" action="">
        <div class="wrapper">
            <h2>Melden gratis aan</h2>
            <div class="naam">
                <input type="text" id="Gebruikersnaam" name="Gebruikersnaam" placeholder="Gebruikersnaam" required>
            </div>
            <div class="gegevens">
                <input type="Pasword" id="Wachtwoord" name="Wachtwoord" placeholder="Wachtwoord"  required>
            </div>
            <div class="file">
                <input type="submit" value="inlog" name="inlog">
            </div>
            <div class="file">
                <p>Inlog gegevens: jelle/wijma</p>
                <button><a href="register.php">Nog geen gebruiker?</a></button>
            </div>
        </div>
    </form>


  <?php
}
?>
</body>

</html>