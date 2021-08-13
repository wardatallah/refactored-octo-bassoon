<?php
require_once __DIR__."/BaseView.php";
require_once __DIR__."/../controllers/PlayersController.php";
require_once __DIR__."/../templates/index.php";

class PlayersView implements BaseView {
    private $controller;

    public function __construct() {
        $this->controller = new PlayersController();
    }

    public function css() {
        return [
            'PlayersView.css'
        ];
    }

    public function template() {
        return __DIR__."/../templates/PlayersTemplate.php";
    }

    public function cli() {
        echo "Current Players: \n";
        foreach ($this->controller->getData() as $player) {
            echo "\tName: $player->name\n";
            echo "\tAge: $player->age\n";
            echo "\tSalary: $player->salary\n";
            echo "\tJob: $player->job\n\n";
        }
    }

    public function render() {
        $rows = array('players' => $this->controller->getData());
        printf(template($this->template(), $rows));
     }
}
