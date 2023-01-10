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
      </div>
    </div>
    
<div class="container md-3" style="width: 40rem;">
<h3 align="center" ><?PHP echo $userACC?>'s Orders</h3>


    <?PHP
    $query = "SELECT * FROM `customer_order` WHERE `email_address`='{$_SESSION['user']}' ORDER BY 'date' DESC";
    $results = $db->query($query);
    $num_results = $results->num_rows;
    
    
    
 
 

 
    for ($i=0; $i < $num_results; $i++){ 
        $row = $results->fetch_assoc();
        
        $QTY = $row['QTY'];
        $pName = $row['pName'];
        $price = $row['price'];
        $total = $row['total'];
        $image =  "./images/(".$row['product_ID'].").jpg";
        $date = $row['date'];
        ?>
        <br>
    
        
    <table class="table">

      <td>
          
      <div align="center" ><img style="width:200px" src="<?php echo $image ?>">      
          
      <h6><?php echo $pName; ?></h6>


      <h6>QTY: <?php echo $QTY; echo '<br>'; ?></h6>

    
      <h6>Price:$<?php echo $price; echo '<br>'; ?></h6>
      
      
      <h6>Your Total:$<?php echo $total;?></h6>
      
      
      <h6>Date of purchase: <?php echo $date; echo '<br>'; ?></h6>
      </div>
      
      </td>

    </table>
      
        
   <?PHP } ?>
    </div>
    <br/>
    <br/>

    
</body>
</html>