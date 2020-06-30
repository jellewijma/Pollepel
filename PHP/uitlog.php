<?php
//Start de sessions
session_start();
//Verwijder alle sessions
session_destroy();
//stuur de gebruiker naar de inlogpagina
header("location:index.php");
?>