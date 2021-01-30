<?php

class Car{
    //parent class
    public $model;
    public $car;

    public function __construct($model,$car)
    {
        $this->model=$model;
        $this->car=$car;
    }

    public function display(){
        return "My model is " .$this->model ."<br>";
    }

    //to prevent child class from overriding this method
    final public function hello(){
        return "This was fun xD!\n";
    }
}

class Sports extends Car{
    //child class

    //parent class codes present, but hidden

    //child class codes
    private $date;

    public function setDate($date){
        $this->date=$date;
    }

    public function getDate(){
        return $this->date;
    }

    //override method of parent class (also changes value in parent class)
    public function display()
    {
        return "I bought the car in " .$this->getDate() ."<br>";
    }

}

$car1 = new Sports("BMW","red");
echo $car1->display(); //using parent class method
echo $car1->hello();

$car1->setDate(2007);
echo "<br>";

echo $car1->display(); //override parent class method





?>
