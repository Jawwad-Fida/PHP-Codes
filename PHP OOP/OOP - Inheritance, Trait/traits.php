<?php
declare(strict_types=1);

//Car trait 
trait Car{
    public $color, $model;
    public $total_wheels;

    public function __construct(string $color, string $model, int $wheels)
    {
        $this->color = $color;
        $this->model = $model;
        $this->total_wheels = $wheels;
    }

}

//Parent Class
class Wheel{

    use Car;

    public function hasWheels(){
        if($this->total_wheels == 4){
            return true;
        }
        echo "All Wheels are not working properly <br>";
        return false;
    }

}

//Child Class
class Engine extends Wheel{

    public function key_turned(){
        if($this->hasWheels() == true){
            return true;
        }
        return false;
    }

    public function is_on(){
        if($this->key_turned() == true ){
            echo "Engine Start <br>";
            return true;
        }
        echo "Engine Fail to Start <br>";
        return false;
    }

    public function moveForward(){
        if($this->is_on() == true){
            echo "Car is moving forward <br>";
        }
        else{
            echo "Engine did not start yet. Car is not unable to move forward <br>";
        }
    }
}

$car1 = new Engine("Red","BMW",4);
echo $car1->moveForward();


