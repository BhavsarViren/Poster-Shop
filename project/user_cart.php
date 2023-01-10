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
    <title>Cart Page</title>
 

</head>
<body>
    
<!-- header nav bar -->
    <div class="container-fluid bg-dark text-center text-light">
      <div class="text-end">
      <h1>Poster Shop</h1>
      <a align="left" href="home.php" class="btn btn-secondary">Home</a>
      <a href="signout.php" class="btn btn-secondary">Log Out</a>
      <a href="user_cart.php" class="btn btn-secondary text-end">Cart</a>
      <a href="View_order.php" class="btn btn-success " >View orders</a>
      </div>
    </div>
    
<div class="container md-3" style="width: 40rem;">
<h3 align="center" ><?PHP echo $userACC?>'s Cart</h3>



    <?PHP
    $query = "SELECT * FROM `customer_cart` WHERE `customer_email`='{$_SESSION['user']}'";
    $results = $db->query($query);
    $num_results = $results->num_rows;
    
    
    
 
 

 
    for ($i=0; $i < $num_results; $i++){ 
        $row = $results->fetch_assoc();
        
        $cartID = $row['cartID'];
        $pName = $row['productName'];
        $QTY = $row['QTY'];
        $price = $row['price'];
        $total = $QTY * $price;
        $image =  "./images/(".$row['itemID'].").jpg";
        ?>
        <br>
        
    
        
    <table class="table">

      <td>
          
      <div align="center" ><img style="width:200px" src="<?php echo $image ?>">      
          
      <h6><?php echo $pName; ?></h6>


      <h6>QTY: <?php echo $QTY; echo '<br>'; ?></h6>

    
      <h6>Price:$<?php echo $price; echo '<br>'; ?></h6>
      
      <h6>Your Total:$<?php echo $total;?></h6>
      
      <form method="post" action="remove.php">
          <input type = "hidden" name = "cartID" value = "<?PHP echo $cartID?>" />
          <input type="submit" value="remove from Cart" class="btn btn-danger" />
          
      </form>
      </div>
      
      </td>

    </table>
      
        
   <?PHP } ?>
    <div class="d-grid gap-3">
    <?PHP
    if($num_results == 0){
        ?>
        <h1 align="center">Your Cart is empty</h1>
        <h3 align="center">Start Shopping!</h3>
    <?PHP }
    else{
        ?>
        <a href="orders.php" class="btn btn-success " role="button" >Continue to checkout</a>
    <?PHP } ?>
    </div>
    </div>
    <br/>
    <br/>

    
</body>
</html>