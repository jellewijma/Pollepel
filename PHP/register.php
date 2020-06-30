<?php include('server.php')?>

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
        <?php include('errors.php');?>
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
