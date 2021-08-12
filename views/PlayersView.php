<?php

require_once __DIR__."/../controllers/PlayersObject.php";

$isCLI = php_sapi_name() === 'cli';

$playersObject = new PlayersObject();

$filename = __DIR__."/../data/playerdata.json";

$playersObject->readPlayers('array', $filename);

if ($isCLI) {
    echo "Current Players: \n";
    foreach ($players as $player) {

        echo "\tName: $player->name\n";
        echo "\tAge: $player->age\n";
        echo "\tSalary: $player->salary\n";
        echo "\tJob: $player->job\n\n";
    }
} else {

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="../assets/PlayersView.css">
    </head>
    <body>
        <?php echo $playersObject->display(); ?>
    </body>
    </html>

 <?php } ?>