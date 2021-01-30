<?php

$arr = array(); //empty array

//array_push($arr,$value) - used to add a new element at the end of the array
array_push($arr,"Jawwad");
array_push($arr,23);
array_push($arr,12);

//print_r($arr) - print array
print_r($arr);
echo "<br>";

//array_pop($arr) - removes the last element of the array
array_pop($arr);

echo "After removal = ";
print_r($arr);
echo "<br>";

//sizeof($arr) or count($arr) - returns size of array (no. of elements inside array)
$size = sizeof($arr);

echo "Size of array = $size";
echo "<br>";

//is_array($arr) - To check whether the provided data is in form of an array
if(is_array($arr)){
    echo "It is an Array";
    echo "<br>";
}
else{
    echo "Not an array";
    echo "<br>";
}

//in_array($var, $arr) - check whether a certain value is present in the array or not
if(in_array("Jawwad",$arr)){
    echo "Value is present in the array";
    echo "<br>";
}
else{
    echo "Value is not present in the array";
    echo "<br>";
}

//array_merge($arr1, $arr2) - combine two different arrays into a single array
$arr2 = array(
    "Student" => "Jishan",
    "Age" => 18,
    "Car" => "Toyota"
);

$merged = array_merge($arr,$arr2);
echo "Merged  array = ";
print_r($merged);
echo "<br>";

//In an associative array, data is stored in form of key-value pairs.

//array_values($arr) - take all the values from array, without the keys, and store them in a separate array
$values = array_values($merged);
echo "Only values = ";
print_r($values);
echo "<br>";

//array_keys($arr) - extract keys from an array
$keys = array_keys($merged);
echo "Only keys = ";
print_r($keys);
echo "<br>";

//array_shift($arr) - can be used to remove the first element out of the array
$firstElement = array_shift($arr);
print_r($firstElement);
echo "<br>";

//---------------------------NEW ARRAY-----------------------
function sum($val){
    return ($val + 1);
}

$numbers = array(10,20,30,40,50);

//array_map('function_name', $arr) - define a separate function to which we will provide the values stored in the array one by one(one at a time) and it will perform the operation on the values. 
$numbers = array_map('sum',$numbers);
print_r($numbers); //all numbers in the array have changed

//array_reverse($arr) - is used to reverse the order of elements 
print_r(array_reverse($arr));
echo "<br>";

//array_rand($arr) - pick random data element from an array
echo $numbers[array_rand($numbers)];
echo "<br>";

//array_slice($arr, $offset, $length) - create a subset of any array.
//$offset = starting point (index from where the subset starts)
//$length = number of elements required in the subset (starting from the offset)
print_r(array_slice($arr,0,2));
echo "<br>";




?>