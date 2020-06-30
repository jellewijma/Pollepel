<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temporary image form</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="userfile[]" value="" multiple="">
        <input type="submit" name="submit" value="upload">
    </form>
</body>

<?php 

$mysqli = new mysqli('localhost','root', ,'images') or die ($mysqli->connect_error);
$table = 'Beroeps_Images';


</html>