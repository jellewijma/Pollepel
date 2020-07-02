<?php

session_start();
if (!isset($_SESSION['Gebruikersnaam'])) {
  $switch = "inlog";
} else {
  $switch = "uitlog";
}

//voeg de koppeling naar de database toe
require 'config.php';

//lees het formulier uit
$Search = $_POST['search'];

//maak de query:
$query = "SELECT * FROM `Beroeps_Recept` WHERE Title LIKE '%" . $Search . "%' OR Category LIKE '%" . $Search . "%'";

//TEST: schrijf de query naar het scherm (TIJDELIJKE CODE!)
// echo $query;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../CSS/Style.css"/>
  <script src="../JS/JS.js"></script>
</head>
<body>
<header>
  <div class="Search">
    <form action="search.php" method="post">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit"><i class="fa fa-search"></i></button>
    </form>
  </div>
  <h1>Japan</h1>
  <button>Sign-in</button>
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
</header>
<main>
  <h2>Search Results</h2>
  <?php
  // als de opdracht goed word uitgevoerd:
  if($Resultaat = mysqli_query($mysqli, $query))
  {
    while ($Recept = mysqli_fetch_array($Resultaat)){
      echo "<table border=1 cellspacing='0' cellpadding='3'>";
      echo "<tr><td>" . $Recept['Image'] . "</td></tr>";
      echo "<tr><td>" . $Recept['Title'] . "</td></tr>";
      echo "<tr><td>" . $Recept['Text'] . "</td></tr>";
      echo "<tr><td>" . $Recept['Category'] . "</td></tr>";
      echo "</table>";
    }
  }
// anders:
  else{
    echo "<p>FOUT bij opzoeken.</p>";
    echo mysqli_error($mysqli); //LET OP: tijdelijk toegevoegen
  }
  ?>
</main>
</body>
</html>