<?php

class Player {
	public $name;
    public $age;
    public $job;
    public $salary;

    public function __construct($pName, $pAge, $pJob, $salary) {
        $this->name = $pName;
        $this->age = $pAge;
        $this->job = $pJob;
        $this->salary = $salary;
    }
}


?>