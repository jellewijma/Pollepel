<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['Gebruikersnaam'])) {
$switch = "inlog";
} else {
  echo "test2";
    $switch = "uitlog";
if ($_SESSION['Level'] == 0) {
echo "<p>U heeft geen rechten om deze pagina te bekijken.</p>";
echo "<p><a href='artiest_uitlees.php'>Ga terug</a></p>";
}
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
                <a class="test" href="#wrapTop" onclick="setTimeout(closeNav, 800)"
                >ME</a
                >
            </li>
            <li>
                <a class="test" href="#photography" onclick="setTimeout(closeNav, 800)"
                >Photography</a
                >
            </li>
            <li>
                <a
                        class="test"
                        href="#graphicDesign"
                        onclick="setTimeout(closeNav, 800)"
                >graphic Design</a
                >
            </li>
            <li>
                <a
                        class="test"
                        href="#WebDevelopment"
                        onclick="setTimeout(closeNav, 800)"
                >Web Development</a
                >
            </li>
            <li><a class="test" href="moreInfo.html">More Info</a></li>
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