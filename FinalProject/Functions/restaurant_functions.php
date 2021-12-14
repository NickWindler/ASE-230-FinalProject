<?php

class restaurantFunctions {

    function getRestaurantTypes($db) {
        $array = [];
        $stmt = $db->query('SELECT * FROM types');
        while ($row = $stmt->fetch())
            array_push($array, $row);
        return $array;
    }

    function getRestaurants($db) {
        $array = [];
        $stmt = $db->query('SELECT * FROM restaurants');
        while ($row = $stmt->fetch())
            array_push($array, $row);
        return $array;
    }

    function getRestaurantsByType($typeID, $db) {
        $array = [];
        $stmt = $db->prepare('SELECT * FROM restaurants WHERE type_id = ?');
        $stmt->execute([$typeID]);
        while ($row = $stmt->fetch())
            array_push($array, $row);
        return $array;
    }

    function createRestaurant($typeID, $name, $street, $city, $zip, $state, $rating, $imageURL, $db) {
        $stmt = $db->prepare('INSERT INTO restaurants (type_id, name, street, city, zip, state, rating, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$typeID, $name, $street, $city, $zip, $state, $rating, $imageURL]);
        $stmt->fetch();
        echo "<script>window.location.href='../admin.php';
		 alert('Restaurant has been created')</script>";
    }

    function modifyRestaurant($id, $typeID, $name, $street, $city, $zip, $state, $rating, $imageURL, $db) {
        $stmt = $db->prepare('UPDATE restaurants SET type_id = ?, name = ?, street = ?, city = ?, zip = ?, state = ?, rating = ?, image_url = ? WHERE ID = ?');
        $stmt->execute([$typeID, $name, $street, $city, $zip, $state, $rating, $imageURL, $id]);
        $stmt->fetch();
        echo "<script>window.location.href='../admin.php';
		 alert('Restaurant has been modified')</script>";
    }

    function deleteRestaurant($id, $db) {
        $stmt = $db->prepare('DELETE FROM restaurants WHERE ID = ?');
        $stmt->execute([$id]);
        $stmt->fetch();
        echo "<script>window.location.href='../admin.php';
		 alert('Restaurant has been deleted')</script>";
    }

    function searchRestaurant($name, $db) {
        $array = [];
        $stmt = $db->prepare('SELECT * FROM restaurants WHERE name = ?');
        $stmt->execute([$name]);
        while ($row = $stmt->fetch())
            array_push($array, $row);
        return $array;
    }

}

?>