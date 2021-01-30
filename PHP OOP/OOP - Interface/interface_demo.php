<?php
declare(strict_types=1);

//we will create an interface for the classes that handle cars
interface Car{
    //define the rules that all child classes using this interface should follow
    public function setModel(string $model); //these are abstract
    public function getModel();
}

//create another interface
interface Vehicles{
    public function setWheels(bool $wheel);
    public function hasWheels();
}

//The classes that implement the interfaces must define all the methods that they inherit from the interfaces, including all the parameters
class MiniCar{
    public $model, $wheel;

    //Car interface
    public function setModel(string $model){
        $this->model = $model;
    }

    public function getModel(){
        return $this->model ."<br>";
    }

    //Vehicle interface
    public function setWheels(bool $wheel){
        $this->wheel=$wheel;
    }

    public function hasWheels(){
        if($this->wheel == true) return $this->model ." has wheels" ."<br>";
        else return $this->model ." has no wheels" ."<br>"; 
    }

}

$car = new MiniCar();
$car->setModel("BMW");
$car->setWheels(true);
echo $car->hasWheels();


?>
