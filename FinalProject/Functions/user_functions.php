<?php

class userFunctions {

    function getUsers($db) {
        $array = [];
        $stmt = $db->query('SELECT * FROM users');
        while ($row = $stmt->fetch())
            array_push($array, $row);
        return $array;
    }

    function modifyUser($id, $fName, $lName, $email, $password, $phone, $loggedUser, $db) {
        $stmt = $db->prepare('UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ?, phone = ? WHERE ID = ?');
        $stmt->execute([$fName, $lName, $email, $password, $phone, $id]);
        $stmt->fetch();
		if($loggedUser == $id)
			$_SESSION['email'] = $email;
        echo "<script>window.location.href='profile.php?id=".$id."';
		 alert('Profile has been modified')</script>";
    }

    function deleteUser($id, $loggedUser, $db) {
        $stmt = $db->prepare('DELETE FROM users WHERE ID = ?');
        $stmt->execute([$id]);
        $stmt->fetch();
		if($id == $loggedUser) {
			echo "<script>window.location.href='../Views/Authentication/sign-out.php';
				alert('Profile has been deleted')</script>";
		}
		else {
			echo "<script>window.location.href='../Views/admin.php';
				alert('Profile has been deleted')</script>";
		}
    }

    function searchUser($name, $db) {
        $array = [];
        $stmt = $db->prepare('SELECT * FROM users WHERE concat(first_name, " ",last_name) = ? OR first_name = ? OR last_name = ?');
        $stmt->execute([$name, $name, $name]);
        while ($row = $stmt->fetch())
            array_push($array, $row);
        return $array;
    }

}

?>