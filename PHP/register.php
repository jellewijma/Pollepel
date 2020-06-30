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
        <div class="input-group">
            <label>Profiel Foto</label>
            <input type="file" name="imageField" value="<?php echo $UserProfile; ?>">
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

<form name="form1" action="" method="POST" enctype="multipart/form-data">
    <table width="400" border="0">
        <tr>
            <td>Volledigenaam:</td>
            <td><input type="text" id="Naam" name="Naam" value="" required></td>
        </tr>
        <tr>
            <td>Gebruikernaam:</td>
            <td><input type="text" id="Gebruikernaam" name="Gebruikernaam" value="" required></td>
        </tr>
        <tr>
            <td>Geboortedatum:</td>
            <td><input type="date" id="Date" name="Date" value="" required></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" id="Email" name="Email" value="" required></td>
        </tr>
        <tr>
            <td>wachtwoord:</td>
            <td><input type="password" id="Password" name="Password" value="" required></td>
        </tr>
        <tr>
            <td>telefoon nummer:</td>
            <td><input type="text" id="Telefoonnummer" name="Telefoonnummer" value=""></td>
        </tr>
        <tr>
            <td>profiel foto:</td>
            <td><input type="file" id="profielfoto" name="userfile[]" value=""></td>
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
    $opdracht = "INSERT INTO `Beroeps_User` VALUES (NULL, '$Naam', '$Gebruikernaam', '$Date', '$Email', '$Password', '$Telefoonnummer', '$profielfoto', '0')";

    if (mysqli_query($mysqli, $opdracht)) {
      echo "U bent toegevoegd!<br/>";
    } else {
      echo "FOUT bij toevoegen van uw profiel!<br/>";
      echo "Query: $opdracht <br/>";
      echo "Foutmelding: " . mysqli_error($mysqli);
    }


    $table = 'Beroeps_User';



    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );

    //$_$FILES global variable
if(isset($_FILES['userfile'])){
    
    $file_array = reArrayFiles($_FILES['userfile']);
    //pre_r($file_array);
    for ($i=0;$i<count($file_array);$i++){
        if ($file_array[$i]['error']) 
        {
            ?> <div class="alert alert-danger"> 
            <?php echo $file_array[$i]['Name'].' - '.$phpFileUploadErrors[$file_array[$i]['error']]; 
            ?> </div> <?php
        }
        else {
            
            $extensions = array('jpg','png','gif','jpeg');
            
            $file_ext = explode('.',$file_array[$i]['Name']);
            
            $Name = $file_ext[0];
            $Name = preg_replace("!-!"," ",$Name);
            $Name = ucwords($Name);
            
            $file_ext = end($file_ext);
            
            if (!in_array($file_ext, $extensions)) 
            {
                ?> <div class="alert alert-danger"> 
                <?php echo "$Name - Invalid file extension!"; 
                ?> </div> <?php
            }
            else {
                
                $img_dir = 'Resorce/web/profile/'.$file_array[$i]['Name'];
                
                move_uploaded_file($file_array[$i]['tmp_name'], $img_dir);
                
                $sql = "INSERT IGNORE INTO $table (name,img_dir) VALUES('$Name','$img_dir')";
                $mysqli->query($sql) or die($mysqli->error);
                
                ?> <div class="alert alert-success"> 
                <?php echo $Name.' - '.$phpFileUploadErrors[$file_array[$i]['error']]; 
                ?> </div> <?php
            }
        }
    }
}


function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['Name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }

    return $file_ary;
}

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}


  }

  ?>
</body>
    <a href="inlog.php">Inloggen</a>
</html>