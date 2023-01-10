<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
    
<?php

require "../databaseConnection/database_connect.php";
$db = connect();
$QTY = $_POST['QTY'];
$id = $_POST['id'];
$name = $_POST['name'];
$userACC = $_SESSION['user'];
$price = $_POST['price'];

$inv="SELECT `quantity` FROM `inventory` WHERE `productID` = '{$_POST['id']}' ";
$result = $db->query($inv);
$num_result = $result->num_rows;
$row = $result->fetch_assoc();
$curr_qty = $row['quantity'];


if($curr_qty >= $QTY){
    
    
    $sql ="INSERT INTO customer_cart (itemID, QTY, productName, customer_email, price)
    VALUES ('$id', '$QTY', '$name', '$userACC', '$price');";
    $db->query($sql);
    
    $Qua = $curr_qty - $QTY;
    $upd = "UPDATE `inventory` SET `quantity` = '$Qua'  WHERE `inventory`.`productID` = '{$_POST['id']}'";
    $db->query($upd);
    
    ?>
    <br>
    <div align="center" class="container mt-3">
    <h1><?PHP echo $_POST['name']; ?> has been added to cart!</h1>
    <a href="../home.php" class="btn btn-primary" role="button">Return to Products</a>
    </div>
    
    <?PHP

}
else{?>
    <br>
    <div align="center" class="container mt-3">
    <h1>Sorry but we dont have enough posters of <?PHP echo $_POST['name']; ?> in inventory! </h1>
    <a href="../home.php" class="btn btn-primary" role="button">Return to Products</a>
    </div>
    
<?PHP }

$db->close();

$result->free();


?>

</body>
</html>