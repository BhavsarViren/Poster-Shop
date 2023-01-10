<?php
    header('location: user_cart.php');
    include "./databaseConnection/database_connect.php"; 
    $db=connect();

    $cartID = $_POST['cartID'];
    
    $grab = "SELECT * FROM `customer_cart` WHERE `cartID`  ='{$_POST['cartID']}' ";
    $result = $db->query($grab);
    $row = $result->fetch_assoc();
    $cart_qty = $row['QTY'];
    $itemID = $row['itemID'];
    
    $inv="SELECT `quantity` FROM `inventory` WHERE `productID` = '$itemID' ";
    $res = $db->query($inv);
    $am = $res->fetch_assoc();
    $inv_qty = $am['quantity'];
    
    $curr_qty = $cart_qty + $inv_qty;
    
    $upd = "UPDATE `inventory` SET `quantity` = '$curr_qty'  WHERE `inventory`.`productID` = '$itemID'";
    $db->query($upd);
    
    $sql = "DELETE FROM `customer_cart` WHERE `cartID`  ='{$_POST['cartID']}' ";
    $db->query($sql);
    
    
    
    

?>

