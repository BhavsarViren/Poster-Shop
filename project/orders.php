<?PHP
session_start();
include "./databaseConnection/database_connect.php"; 
$db=connect();
$userACC = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Ordert Page</title>
 

</head>
<body>
    
    <!-- header nav bar -->
    <div class="container-fluid bg-dark text-center text-light">
      <div class="text-end">
      <h1>Poster Shop</h1>
      <a align="left" href="home.php" class="btn btn-secondary">Home</a>
      <a href="signout.php" class="btn btn-secondary">Log Out</a>
      <a href="user_cart.php" class="btn btn-secondary text-end">Cart</a>
      </div>
    </div>
    

    <?PHP
    $query = "SELECT * FROM `customer_cart` WHERE `customer_email` ='{$_SESSION['user']}'";
    $results = $db->query($query);
    $num_results = $results->num_rows;
    
    
    $sql = "SELECT * FROM `customer_accounts` WHERE `email_address` ='{$_SESSION['user']}'";
    $res = $db->query($sql);
    $info = $res->fetch_assoc();
    
    $fname = $info['firts_name'];
    $lname = $info['last_name'];
    $zip = $info['zip_code'];
    $street = $info['street_name'];
    $state = $info['state'];
    $city = $info['city'];
    $email = $info['email_address'];
    $bldNum = $info['building_house_number'];
    $cc_pin = $info['cc_pin'];
    $cc_exp = $info['cc_expiration'];
    $cc_num = $info['cc_number'];
 
    $order_total = '';
    ?>
 
    <br>
    <div class="container" style="width: 25rem;">
        <h3><?PHP echo $userACC?>'s Cart</h3>
    <table class="table">

    <td>
    <?PHP
    for ($i=0; $i < $num_results; $i++){ 
        $row = $results->fetch_assoc();
        
        $cartID = $row['cartID'];
        $pName = $row['productName'];
        $QTY = $row['QTY'];
        $price = $row['price'];
        $total = $QTY * $price;
        ?>
        
        <h6>Item: <?php echo $pName; ?></h6>


        <h6>QTY: <?php echo $QTY; echo '<br>'; ?></h6>

    
        <h6>$<?php echo $price; echo '<br>'; ?></h6>
      
        <h6>Total:$<?php echo $total; echo '<br>'; ?></h6>
        
        <?PHP $order_total = $order_total + $total?>
        <br/>
        
   <?PHP } ?>
   
    </td>

    </table>
    </div>
    <br>
    <h4 align="center" >Your Total today is: $<?PHP echo $order_total;?></h4>
    <br/>
    <div class="card">
    <br/>
    <h4>User Information:</h4>
    <h6>Name: <?php echo $fname; echo " "; echo $lname;?></h6>
    <h6>Zip Code: <?php echo $zip; ?></h6>
    <h6>State: <?php echo $state; ?></h6>
    <h6>City: <?php echo $city; ?></h6>
    <h6>Street: <?php echo $street; ?></h6>
    <h6>Building number: <?php echo $bldNum; ?></h6>
    
    <form method="post" action="order_confirm.php">
          <input type="submit" value="Place Order!" class="btn btn-success" />
    </form>
    </div>
    
    <br/> 
    <br/>
    
</body>
</html>