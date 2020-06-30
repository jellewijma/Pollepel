<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../CSS/Style.css"/>
    <script src="../JS/JS.js"></script>
</head>
<body>
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
            <a class="test" href="mijnrecepten.php" onclick="setTimeout(closeNav, 800)"
            >Mijn recepten</a
            >
        </li>
        <li>
            <a class="test" href="recepte_maken.php" onclick="setTimeout(closeNav, 800)"
            >Recepten editen</a
            >
        </li>
    </ul>
</div>
</body>
</html>
