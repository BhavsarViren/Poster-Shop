<?php
include "../../databaseConnection/database_connect.php";
$db = connect();

/*
 This updates the poster table whenever there are changes needed.
*/

// Set variables

$productID = $_POST['productID'];
$image_color = $_POST['image_color'];
$orientation = $_POST['orientation'];
$category = $_POST['category'];
$new_name = $_POST['new_title'];
$new_price = $_POST['new_price'];
$new_visibility = $_POST['new_visibility'];

$update_poster = "UPDATE `poster` 
SET `category` = '$category',`orientation` = '$orientation' ,`color_profile` = '$image_color'   
WHERE `poster`.`productID` = $productID;
";
$update_inventory = "UPDATE `inventory` 
SET `posterName` = '$new_name', `visibility` = '$new_visibility', `price` = '$new_price' 
WHERE `inventory`.`productID` = $productID;";


// echo $update;



$updates = $db -> query($update_poster);
$updates = $db -> query($update_inventory);
$db->close();

header("location: ../product_manager_pannel.php");


?>