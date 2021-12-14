<?php

class mealFunctions {

    function getMealsForRestaurant($id, $db) {
        $array = [];
        $stmt = $db->prepare('SELECT * FROM meals WHERE restaurant_id = ?');
        $stmt->execute([$id]);
        while ($row = $stmt->fetch())
            array_push($array, $row);
        return $array;
    }

    function createMeal($restaurantID, $name, $price, $description, $imageURL, $rName, $db) {
        $stmt = $db->prepare('INSERT INTO meals (restaurant_id, name, price, description, image_url) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$restaurantID, $name, $price, $description, $imageURL]);
        $stmt->fetch();
        echo "<script>window.location.href='meals.php?id=".$restaurantID."&name=".$rName."';
		 alert('Meal has been created')</script>";
    }

    function modifyMeal($id, $restaurantID, $name, $price, $description, $imageURL, $rName, $db) {
        $stmt = $db->prepare('UPDATE meals SET name = ?, price = ?, description = ?, image_url = ? WHERE ID = ?');
        $stmt->execute([$name, $price, $description, $imageURL, $id]);
        $stmt->fetch();
        echo "<script>window.location.href='meals.php?id=".$restaurantID."&name=".$rName."';
		 alert('Meal has been modified')</script>";
    }

    function deleteMeal($id, $restaurantID, $rName, $db) {
        $stmt = $db->prepare('DELETE FROM meals WHERE ID = ?');
        $stmt->execute([$id]);
        $stmt->fetch();
        echo "<script>window.location.href='meals.php?id=".$restaurantID."&name=".$rName."';
		 alert('Meal has been deleted')</script>";
    }

}


?>