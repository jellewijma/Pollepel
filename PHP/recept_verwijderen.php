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
        <link href="https://fonts.googleapis.com/css2?family=Stylish&display=swap" rel="stylesheet">
        <title>Document</title>
    </head>
    <body>
    <p>Weet je zeker dat je de onderstaande artiest wilt verwijderen?</p>
    <form name="form1" action="" method="POST" enctype="multipart/form-data">
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
                <td><input type="submit" value="verwijder" name="verwijder"></td>
            </tr>
        </table>
        <a href='mijn_recepten.php'>Naar Mijn recepten</a><br/>
    </body>
    </html>
  <?php
  if (isset($_POST['verwijder'])) {
    require('config.php');
    //maak de query:
    $opdracht = "DELETE FROM Beroeps_Recept WHERE Recept_ID = '$recept'";
    $img = "..//Resorce/ReceptFoto/" . $rij['Image'];
    if (mysqli_query($mysqli, $opdracht)) {
        unlink($img);
      echo $rij['Title'] . " is verwijderd!<br/>";
    } else {
      echo "FOUT bij het aan verwijderen van " . $rij['Title'] . "!<br/>";
      echo "Query: $opdracht <br/>";
      echo "Foutmelding: " . mysqli_error($mysqli);
    }
  }
}
echo "<p>Terug naar <a href='mijn_recepten.php'>overzicht</a></p>";
?>