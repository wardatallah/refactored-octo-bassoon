<?php

require_once __DIR__."/../models/Player.php";

interface IReadWritePlayers {
    function readPlayers($source, $filename = null);
    function writePlayers($filename = null);
}

class PlayersModel {
	/* $players variable will be used to store the data
	 * it doesn't matter where the data is coming from
	 * it will be stored in $players variable
	 */ 
	private $players = [];

    public function __construct() {}

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

        $this->players = $playerData;

    }

    /**
     * @param $filename string Only used if we're writing in 'file' mode
     */
    function writePlayers($filename = null) {
    	if (file_exists($filename)) {
    		file_put_contents($filename, $this->toJSON());
    	}
    }

    public function addPlayer($player) {
    	$this->players[] = $player;
    }

    public function toJSON() {
    	return json_encode($this->players);
    }

    public function getPlayers() {
    	return $this->players;
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
}