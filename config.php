<?php
// foutmelding zichtbaar maken
error_reporting(E_ALL);
ini_set('display_errors','1');
// database logingegevens
$db_hostname = 'localhost';
$db_username = 'ftp84667';

$db_password = '#1Geheim';
$db_database = '84667_PHP';

// maak de database-verbinding
$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

// als de verbinding niet gemaakt kan worden: geef een foutmelding
if (!$mysqli){
    echo "FOUT: geen connectie naar database.<br>";
    echo "Errno: " . mysqli_connect_errno() . "<br>";
    echo "Error: " . mysqli_connect_error() . "<br>";
    exit;
}
?>