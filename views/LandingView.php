<?php
require_once __DIR__."/BaseView.php";
require_once __DIR__."/../templates/index.php";

class LandingView implements BaseView {

    public function __construct() {}

    public function css() {
        return [];
    }

    public function template() {
        return __DIR__."/../templates/LandingTemplate.php";
    }

    public function cli() {
        echo "Landing Page";
    }

    public function render() {
        $rows = array('title' => 'Landing Page');
        printf(template($this->template(), $rows));
     }
}
