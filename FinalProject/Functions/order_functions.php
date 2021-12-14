<?php

class orderFunctions {
	
	function getOrdersForUser($id, $db) {
		$array = [];
		$stmt = $db->prepare('SELECT * FROM orders WHERE user_id = ?');
		$stmt->execute([$id]);
		while ($row = $stmt->fetch())
			array_push($array, $row);
		return $array;
	}
	
	function getOrderDetails($id, $db) {
		$array = [];
		$stmt = $db->prepare('SELECT meals.name, meals.price, restaurants.name AS restaurant_name, 
		orders.date, orders.status from meals_orders, meals, orders, restaurants  WHERE meals.restaurant_id
		= restaurants.ID AND meals_orders.meal_id = meals.ID AND meals_orders.order_id = orders.ID AND orders.ID = ?');
		$stmt->execute([$id]);
		while ($row = $stmt->fetch())
			array_push($array, $row);
		return $array;
	}
	
	function createOrder($userID, $date, $meals, $db) {
		$stmt = $db->prepare('INSERT INTO orders (user_id, status, date) VALUES (?, 0, ?)');
		$stmt->execute([$userID, $date]);
		$stmt->fetch();
		$maxID = $db->query('SELECT MAX(ID) FROM orders');
		$maxID = $maxID->fetch();
		for($i = 0; $i < count($meals); $i++) {
			$insert = $db->query('INSERT INTO meals_orders (order_id, meal_id) VALUES ('.$maxID['MAX(ID)'].', '.$meals[$i][2].')');
			$insert->fetch();
		}
		unset($_SESSION['cart']);
	}
	
}

?>