<?php

class paymentFunctions {

    function getPaymentOptionsForUser($id, $db) {
        $array = [];
        $stmt = $db->prepare('SELECT * FROM payments WHERE user_id = ?');
        $stmt->execute([$id]);
        while ($row = $stmt->fetch())
            array_push($array, $row);
        return $array;
    }

    function createPayment($userID, $cardNumber, $securityCode, $expDate, $db) {
        $stmt = $db->prepare('INSERT INTO payments (user_id, card_number, security_code, expiration_date) VALUES (?, ?, ?, ?)');
        $stmt->execute([$userID, $cardNumber, $securityCode, $expDate]);
        $stmt->fetch();
        echo "<script>window.location.href='../profile.php?id=".$userID."';
		 alert('Payment option has been created')</script>";
    }

    function modifyPayment($id, $userID, $cardNumber, $securityCode, $expDate, $db) {
        $stmt = $db->prepare('UPDATE payments SET card_number = ?, security_code = ?, expiration_date = ? WHERE ID = ?');
        $stmt->execute([$cardNumber, $securityCode, $expDate, $id]);
        $stmt->fetch();
        echo "<script>window.location.href='../profile.php?id=".$userID."';
		 alert('Payment option has been modified')</script>";
    }

    function deletePayment($id, $userID, $db) {
        $stmt = $db->prepare('DELETE FROM payments WHERE ID = ?');
        $stmt->execute([$id]);
        $stmt->fetch();
        echo "<script>window.location.href='../profile.php?id=".$userID."';
		 alert('Payment option has been deleted')</script>";
    }

}

?>