<?php
require('profile_functions.php');
require('restaurant_functions.php');
require('meal_functions.php');
require('C:\xampp\htdocs\FinalProject\DB\db_connect.php');

$restaurantFunctions = new restaurantFunctions();
$mealFunctions = new mealFunctions();
$restaurantArray = $restaurantFunctions->getRestaurants($db);
$typeArray = $restaurantFunctions->getRestaurantTypes($db);

function displayTypes($types, $typeID, $isCurrentType=false, $use) {
    if($use == "modify") {
        if($isCurrentType)
            $selected = 'selected';
        else
            $selected = '';
        echo '<option value="'.$typeID.'" '.$selected.'>'.$types['name'].'</option>';
    }
    else {
        echo '<option value="'.$typeID.'">'.$types['name'].'</option>';
    }
}

function displayRestaurants($restaurants, $restaurantID) {
    echo '<option value="'.$restaurantID.'">'.$restaurants['name']. ' ('.$restaurants['street'].', '.$restaurants['city'].', '.$restaurants['state'].' '.$restaurants['zip'].')'.'</option>';
}

?>