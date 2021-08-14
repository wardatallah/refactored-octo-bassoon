<?php

require_once __DIR__."/../models/PlayersModel.php";

class PlayersController {
    private $model;

    public function __construct() {
        $this->model = new PlayersModel();
        $filename = __DIR__."/../data/playerdata.json";
        $this->model->readPlayers('array', $filename);
    }

    public function getData() {
        return $this->model->getPlayers();
    }

    public function addData($data) {
        $player = json_decode($data);
        $this->model->addPlayer($player);
    }
}

?>