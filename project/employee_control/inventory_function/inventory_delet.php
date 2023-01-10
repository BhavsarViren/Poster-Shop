<?php 
 include "../../databaseConnection/database_connect.php";
 $db = connect();

$productID = $_POST['product_ID_delet'];

$sql = "DELETE FROM `poster` WHERE `poster`.`productID` = $productID";

$delet_poster =  $db -> query($sql);

$db->close();
header('location: ../inventory_manager_pannel.php');
?>