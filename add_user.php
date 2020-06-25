<?php
// voeg het bestand config.php toe:
require 'config.php';
// maak query:
$query = "INSERT INTO back_users VALUES (NULL, 'jelle@gmail.com', 'jelle', 'wijma', 3)";
//voeg de opdracht uit:
mysqli_query($mysqli, $query);
//als de opdracht goed wordt uitgevoerd:
if(mysqli_query($mysqli, $query))
{
    echo "<p>User test1 toegevoegd!.</p>";
}
// anders
else
{
    echo "<p>FOUT bij toevoegen.</p>";
    echo mysqli_error($mysqli); //LET OP: tijdelijk toevoegen
}
