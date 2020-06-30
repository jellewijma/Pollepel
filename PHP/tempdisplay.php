<!DOCTYPE html>
<html>
    <head>
        <title>Display MySQL Images</title>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php


$table = 'Beroeps_User';
        
        $result = $mysqli->query("SELECT * FROM $table") or die($mysqli->error);
        
        while ($data = $result->fetch_assoc()){
            echo "<h2>{$data['name']}</h2>";
            echo "<img src='{$data['img_dir']}' width='40%' height='40%'>";
        }
        
        ?>
    </body>
