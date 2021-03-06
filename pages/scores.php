<?php
    require '../main.php';
    
    // If there is no sport atachment then redir them to the homepage
    if (!isset($_GET["sport"])) {
        header('Location', 'homepage.php');
        exit();
    } 

    // Load get the data of the requested sport
    $requestedSport = strtolower($_GET["sport"]);
    // Determine if file exists
    if (!file_exists('../data/'.$requestedSport.'.json')) {
        header('Location: 404');
        exit();    
    }
    
    $f = fopen('../data/'.$requestedSport.'.json', 'r');;
    $jsonRaw = fread($f, filesize('../data/'.$requestedSport.'.json'));
    fclose($f);
    // Generate the user interface
    $ui = UI::generateUI($jsonRaw);
?>
<!DOCTYPE HTML>
<html>
    <head>
    <title><?php echo ucfirst($requestedSport)?> | Scores</title>
	   <meta charset="UTF-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1">
	   <link rel="stylesheet" href="../css/scores.css" type="text/css" />
	   <link rel="icon" type="image/png" href="../images/crawford_logo.png" />
    </head>
    <body>
        <div class="header" onclick="window.location = '/pages/home'" style="cursor: pointer;"></div>
        <?php if($ui != null){echo($ui->render());}else{echo('Could not find sport! :(');}?>
    </body>
</html>