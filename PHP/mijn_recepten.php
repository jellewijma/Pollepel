<?php
//voeg de koppeling naar de database toe
require 'config.php';
session_start();
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
            >Recepten editen</a
            >
        </li>
    </ul>
</div>

<?php

$query = "SELECT * FROM Beroeps_Recept WHERE Recept_ID IN (SELECT Recept_ID FROM Beroeps_Kopeling WHERE User_ID =" . $_SESSION['User_ID'] . ")";

// als de opdracht goed word uitgevoerd:
if ($Resultaat = mysqli_query($mysqli, $query)) {
  while ($Recept = mysqli_fetch_array($Resultaat)) {
    echo "<table border=1 cellspacing='0' cellpadding='3'>";
    echo "<tr><td>" . $Recept['Image'] . "</td></tr>";
    echo "<tr><td>" . $Recept['Title'] . "</td></tr>";
    echo "<tr><td>" . $Recept['Text'] . "</td></tr>";
    echo "<tr><td>" . $Recept['Category'] . "</td></tr>";
    echo "</table>";
  }
} // anders:
else {
  echo "<p>FOUT bij opzoeken.</p>";
  echo mysqli_error($mysqli); //LET OP: tijdelijk toegevoegen
}

?>

</body>
</html>
