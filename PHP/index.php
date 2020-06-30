<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['Gebruikersnaam'])) {
$switch = "inlog";
} else {
    $switch = "uitlog";
}
?>
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
    <button><a href="<?php echo $switch; ?>.php"><?php echo $switch; ?></a></button>
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
                <a class="test" href="recepte_maken.php" onclick="setTimeout(closeNav, 800)"
                >Recepten maken</a
                >
            </li>
            <li>
                <a class="test" href="mijnrecepten.php" onclick="setTimeout(closeNav, 800)"
                >Mijn recepten</a
                >
            </li>
        </ul>
    </div>
</header>
<main>
    <h2>Welcome</h2>
    <div class="stucture">
        <h3>highlights</h3>
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
    </div>
</main>
</body>
</html>