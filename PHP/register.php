<?php include('config.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="header">
        <h2>Register</h2>
    </div>

    <form method="post" action="register.php">
        <div class="input-group">
            <label>Volledige Naam</label>
            <input type="text" name="fullname" value="<?php echo $FullName; ?>">
        </div>
        <div class="input-group">
            <label>Gebruikersnaam</label>
            <input type="text" name="username" value="<?php echo $UserName; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $Email; ?>">
        </div>
        <div class="input group">
            <label>Wachtwoord</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <label>Telefoon Nummer</label>
            <input type="tel" name="username" value="<?php echo $PhoneNumber; ?>">
        </div>
        <div class="input group">
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
        <p>
            Ben je al een gebruiker? <a href="inlog.php">Log in</a>
        </p>
    </form>   
</body>
</html>


<?php




?>


<html>

<body>
<h2>registreren</h2>

<form name="form1" action="" method="POST">
    <table width="400" border="0">
        <tr>
            <td>:voor en achter naam</td>
            <td><input type="text" id="Naam" name="Naam" value="" required></td>
        </tr>
        <tr>
            <td>Land van herkomst:</td>
            <td><input type="text" id="Gebruikernaam" name="Gebruikernaam" value="" required></td>
        </tr>
        <tr>
            <td>Aantal leden:</td>
            <td><input type="date" id="Date" name="Date" value="" required></td>
        </tr>
        <tr>
            <td>Soort muziek:</td>
            <td><input type="email" id="Email" name="Email" value="" required></td>
        </tr>
        <tr>
            <td>Algemene info:</td>
            <td><input type="password" id="Password" name="Password" value=""></td>
        </tr>
        <tr>
            <td>Algemene info:</td>
            <td><input type="text" id="Telefoonnummer" name="Telefoonnummer" value=""></td>
        </tr>
        <tr>
            <td>Algemene info:</td>
            <td><input type="text" id="profielfoto" name="profielfoto" value=""></td>
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
    $opdracht = "INSERT INTO Beroeps-User VALUES (NULL, '$Naam', '$Gebruikernaam', '$Date', '$Email', '$Password', '$Telefoonnummer', '$profielfoto', '0')";

    if (mysqli_query($mysqli, $opdracht)) {
      echo " is toegevoegd!<br/>";
    } else {
      echo "FOUT bij toevoegen $Bandnaam!<br/>";
      echo "Query: $opdracht <br/>";
      echo "Foutmelding: " . mysqli_error($mysqli);
    }
  }

  ?>
</body>

</html>