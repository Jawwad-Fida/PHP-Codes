<?php
//.class or .inc is just a normal extension for naming purposes

class Person{

    public $name,$age;
    
    public function __construct($name,$age){
        $this->name=$name;
        $this->age=$age;
    }

    public function getPerson(){
        $person = $this->name ." is " .$this->age ." years old"; //statement stored inside a variable
        return $person;
    }
    
        
    

}