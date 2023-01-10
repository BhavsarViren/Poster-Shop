<?php 
 include "../../databaseConnection/database_connect.php";
 $db = connect();
/* 
this process takes steps to update 2 tables
the poster and inventory table
Firstly we insert in the poster table and 
the attribute named in_inventory is set to 0
this would mean that we need to insert it into
our inventory table. 

then we take the newly added entry using sql
statement saying to get all attribures where
in_inventory == 0;

we then take the new items productID

use it in the insert in our inventory table

with the new poster's product ID
alongside that we can not just leave the attributes
for the inventory table as null or blank
so we define preset values such as for the name we say
"Rename as Soon as possible"
and we always want to set visibility to 0 
since we dont want any unfinished product to be vissible
to the customer

sumarize
we insert a new entry in the poster table with the in_inventory = 0
we use that attribute to filter and query for it
we then take the productID of that entity that has in_inventory = 0
we insert that product ID alongside other placeholder info in the invenory table
finaly we update it so that the item we just added has its in_inventory = 1

*/
$orientation = $_POST['orientation'];
$image_color = $_POST['image_color'];
$category = $_POST['category'];
// Set initial 


// initially we have it se to 0 for the in_inventory, entity so we can query later and make updates later
$insert_poster = "INSERT INTO `poster` (`productID`, `category`, `orientation`, `color_profile`, `in_inventory`) 
VALUES (NULL, '$category', '$orientation', '$image_color', '0')
";

$insertion_poster =  $db -> query($insert_poster);



$select_not_in_invnetory= "SELECT * FROM `poster` WHERE `in_inventory` LIKE '0'";

$result = $db->query($select_not_in_invnetory);
$num_results = $result->num_rows;
$row = $result->fetch_assoc();
$new_item = $row['productID'];

$update_status_inventory = "UPDATE `poster` SET `in_inventory` = '1' WHERE `poster`.`productID` = $new_item;";

$insertion_update =  $db -> query($update_status_inventory);



$insert_inventory = 
"INSERT INTO `inventory` (`productID`, `posterName`, `quantity`, `price`, `visibility`) 
VALUES ('$new_item', 'Rename as Soon as possible', '10', '1.0', '0')
";
$insertion_update_inventory = $db -> query($insert_inventory);



disconnect($result,$db);
$db->close();

header("location: ../inventory_manager_pannel.php");

?>