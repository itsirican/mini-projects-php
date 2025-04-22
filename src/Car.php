<?php
  class Car {
    // Props
    private $name;
    private $color;

    public function __construct($name, $color) {
      $this->name = $name;
      $this->color = $color;
    }

    // Methods
    public function getInfos() {
      return "Car name is: ".$this->name." it's color is: ".$this->color."<br>";
    }
  }