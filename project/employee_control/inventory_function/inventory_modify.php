<?php
include "../../databaseConnection/database_connect.php";
$db = connect();

/*
 This updates the poster table whenever there are changes needed.
*/

// Set variables

$productID = $_POST['productID'];
$new_stock = $_POST['new_stockNumber'];

// $update = "UPDATE `poster` SET `category` = '$category',`orientation` = '$orientation' ,`color_profile` = '$image_color' 
// WHERE `poster`.`productID` = $productID;";
$update = "UPDATE `inventory` SET `quantity` = '$new_stock' WHERE `inventory`.`productID` = $productID;";
// UPDATE `inventory` SET `quantity` = '20' WHERE `inventory`.`productID` = 12;

$result =  $db -> query($update);
$db->close();

header("location: ../inventory_manager_pannel.php");


?>