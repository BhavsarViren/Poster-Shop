<?PHP
    session_start();
    require "./databaseConnection/database_connect.php";
    $db = connect();
    $userACC = $_SESSION['user'];

    $query = "SELECT * FROM `customer_cart` WHERE `customer_email` ='{$_SESSION['user']}'";
    $results = $db->query($query);
    $num_results = $results->num_rows;


   

    for ($i=0; $i < $num_results; $i++){ 
        $row = $results->fetch_assoc();
        
        $cartID = $row['cartID'];
        $pName = $row['productName'];
        $QTY = $row['QTY'];
        $price = $row['price'];
        $prod_ID = $row['itemID'];
        $total = $QTY * $price;
        


        $sql ="INSERT INTO customer_order (cartID, pName,product_ID, QTY, price, total, email_address,shipping_status)
        VALUES ('$cartID', '$pName','$prod_ID', '$QTY', '$price', '$total', '$userACC','0');";
        $db->query($sql);
        
    
        $del = "DELETE FROM `customer_cart` WHERE `cartID`  ='{$cartID}' ";
        $db->query($del);
        
        
        $order_total = $order_total + $total;

        // echo $sql;
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>confirmation</title>
</head>
<body>
    <div align="center">
        <h1>Thank You for your purchase!</h1>
        <h4>Receipt</h4>
        <h6>Your total today was:$<?PHP echo $order_total;?></h6>
        <a href="home.php" class="btn btn-primary">Return to Home</a>
    </div>
</body>
</html>