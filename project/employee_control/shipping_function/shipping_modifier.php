<?php
include "../../databaseConnection/database_connect.php";
$db = connect();
$orderID = $_POST['oderID'];


// UPDATE `customer_order` SET `shipping_status` = '1' WHERE `customer_order`.`orderID` = 16;
$update_shipping = "UPDATE `customer_order` SET `shipping_status` = '1' WHERE `customer_order`.`orderID` = $orderID;";

// echo $update_shipping;
$updates = $db -> query($update_shipping);
$db->close();

header("location: ../shipping_manager_pannel.php");


?>