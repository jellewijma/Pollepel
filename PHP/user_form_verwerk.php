<?php

//voeg de koppeling naar de database toe
require 'config.php';

//lees het formulier uit
$Email = $_POST['Email'];
$Gebruikersnaam = $_POST['Username'];
$Wachtwoord = $_POST['password'];
$Level = $_POST['level'];

//maak de query:
$query = "INSERT INTO back_users VALUES (NULL, '$Email', '$Gebruikersnaam', '$Wachtwoord', $Level)";

//TEST: schrijf de query naar het scherm (TIJDELIJKE CODE!)
echo $query;
// als de opdracht goed word uitgevoerd:
if(mysqli_query($mysqli, $query))
{
    echo "<p>User $Gebruikersnaam is toegevoegd!</p>";
}
// anders:
else{
    echo "<p>FOUT bij toevoegen.</p>";
    echo mysqli_error($mysqli); //LET OP: tijdelijk toegevoegen
}
echo "<p><a href='user_form.html'>TERUG</a></p>";
?>