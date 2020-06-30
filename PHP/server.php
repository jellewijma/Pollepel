<?php
session_start();

//Initializeren van de variabelen
$UserName = "";
$Email = "";
$errors = array();

//Connectie met de database
$db = mysqli_connect('localhost', 'root', '', 'registration');

//REGISTREREN VAN GEBRUIKER
if (isset($_POST['reg_user'])) {
    //Ontvang alle input values van formulier
    $UserName = mysqli_real_escape_string($db, $_POST['username']);
    $Email = mysqli_real_escape_string($db, $_POST['email']);
    $Password = mysqli_real_escape_string($db, $_POST['password'])


    //form validatie
    if (empty($FullName)) { array_push($errors, "Volledige Naam is leeg."); }
    if (empty($UserName)) { array_push($errors, "Gebruikersnaam is leeg."); }
    if (empty($Email)) { array_push($errors, "Email is leeg."); }
    if (empty($Password)) { array_push($errors, "Wachtwoord is leeg."); }
    if (empty($PhoneNumber)) { array_push($errors, "Telefoon Nummer is leeg."); 
    
        }


    //bestaat de gebruiker al?
    $user_check_query = "SELECT * FROM Beroeps-User WHERE username='$UserName' OR email=$Email'  LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { //als gebruiker bestaat
        if ($user['username'] === $username) {
            array_push($errors, "Gebruikersnaam is al in gebruik.");
            }

        if ($user['email'] === $email) {
            array_push($errors, "Email is al in gebruik.");
        }
    }

    if (count($errors) == 0){
        $password1 = md5($Password);

        $query = "INSERT INTO Beroeps-User (UserName, Email, Password)
                  VALUES ('$UserName', '$Email', '$password1')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $UserName;
        $_SESSION['success'] = "Je bent nu ingelogd";
        header('location: index.php');
    }
}

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password1 = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($us))
}