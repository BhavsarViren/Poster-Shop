<?php 
include '../../databaseConnection/database_connect.php';

$db = connect();
$new_category = $_POST['new_category_name'];

$sql = "INSERT INTO `poster_category` (`category`) VALUES ('$new_category');";

$result =  $db -> query($sql);



$db->close();
header("location: ../inventory_manager_pannel.php");
?>