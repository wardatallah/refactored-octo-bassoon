<?php

require_once __DIR__."/../models/Player.php";
require_once __DIR__."/../templates/index.php";

interface IReadWritePlayers {
    function readPlayers($source, $filename = null);
    function writePlayer($source, $player, $filename = null);
    function display();
}

class PlayersObject implements IReadWritePlayers {

    private $playersArray;

    private $playerJsonString;

    private $PlayersTemplate = __DIR__."/../templates/PlayersTemplate.php";

    public function __construct() {
        //We're only using this if we're storing players as an array.
        $this->playersArray = [];

        //We'll only use this one if we're storing players as a JSON string
        $this->playerJsonString = null;
    }

    /**
     * @param $source string Where we're retrieving the data from. 'json', 'array' or 'file'
     * @param $filename string Only used if we're reading players in 'file' mode.
     * @return string json
     */
    function readPlayers($source, $filename = null) {
        $playerData = null;

        switch ($source) {
            case 'array':
                $playerData = $this->getPlayerDataArray();
                break;
            case 'json':
                $playerData = $this->getPlayerDataJson();
                break;
            case 'file':
                $playerData = file_get_contents($filename);
                break;
        }

        if (is_string($playerData)) {
            $playerData = json_decode($playerData);
        }

        $this->playersArray = $playerData;

    }

    /**
     * @param $source string Where to write the data. 'json', 'array' or 'file'
     * @param $filename string Only used if we're writing in 'file' mode
     * @param $player \stdClass Class implementation of the player with name, age, job, salary.
     */
    function writePlayer($source, $player, $filename = null) {
        switch ($source) {
            case 'array':
                $this->playersArray[] = $player;
                break;
            case 'json':
                $players = [];
                if ($this->playerJsonString) {
                    $players = json_decode($this->playerJsonString);
                }
                $players[] = $player;
                $this->playerJsonString = json_encode($player);
                break;
            case 'file':
                $players = json_decode(file_get_contents($filename));
                if (!$players) {
                    $players = [];
                }
                $players[] = $player;
                file_put_contents($filename, json_encode($players));
                break;
        }
    }


    function getPlayerDataArray() {
        $players = [];

        $players[] = new Player('Jonas Valenciunas', 26, 'Center', '4.66m');
        $players[] = new Player('Kyle Lowry', 32, 'Point Guard', '28.7m');
        $players[] = new Player('Demar DeRozan', 28, 'Shooting Guard', '26.54m');
        $players[] = new Player('Jakob Poeltl', 22, 'Center', '2.704m');
        
        return $players;
    }

    function getPlayerDataJson() {
        $json = '[{"name":"Jonas Valenciunas","age":26,"job":"Center","salary":"4.66m"},{"name":"Kyle Lowry","age":32,"job":"Point Guard","salary":"28.7m"},{"name":"Demar DeRozan","age":28,"job":"Shooting Guard","salary":"26.54m"},{"name":"Jakob Poeltl","age":22,"job":"Center","salary":"2.704m"}]';
        return $json;
    }

    function display() {
        $rows = array('players' => $this->playersArray);
        return template($this->PlayersTemplate, $rows);
    }
}

?>