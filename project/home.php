<?php
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Document</title>
    
</head>
<body>
    <!-- header nav bar -->
    <div class="container-fluid bg-dark text-center text-light">
      <div class="text-end">
      <h1 align="left">Poster Shop</h1>
      <h6 align="left">Welcome <?php echo $userACC; ?>!</h6>
      <a href="signout.php" class="btn btn-secondary btn-lg">Log Out</a>
      <a href="user_cart.php" class="btn btn-secondary btn-lg">Cart</a>
      <a href="View_order.php" class="btn btn-success btn-lg " >View orders</a>
      <br/>
      </div>
    </div>
    
    <form action="home.php" method="post">
      <input type="text" name="poster_search" class="form-control p-1 mb-1">
      <button type="submit" class="btn btn-primary mb-3">Search Poster 🔍</button>
    </form>
    <!-- Here we make a choice for the searching -->
    <?php
    if (isset($_POST['poster_search']) == FALSE) 
    {
    $sql = "SELECT `inventory`.*, `poster`.*\n"

    . "FROM `inventory` \n"

    . "	LEFT JOIN `poster` ON `inventory`.`productID` = `poster`.`productID`\n"

    . "    WHERE `visibility` = 1;";

    }
    else {
        $search = $_POST['poster_search'];
    $sql = "SELECT `inventory`.*, `poster`.* FROM `inventory` LEFT JOIN `poster` ON `inventory`.`productID` = `poster`.`productID` \n"
    . "WHERE `visibility` = 1 AND `inventory`.`posterName` LIKE '%$search%' ";

    
    
    }
    ?>



    <!-- main posters stuff display -->
    
    <div class="container">
      <div class="row 
      row-cols-2 
      gx-4 gy-3
      p-2 m-2
      text-center">
      
      <?php
      
     
      
      /* 
      we querry 2 table inventory and poster 
      we then join both of them based of the product ID
      from there we can get all the information like:
      Price, Image Directory, and Product name
      we then only show what is visible, aka if visbility == 1
      */
      

      $result = $db->query($sql);
      $num_results = $result->num_rows;
      
      
      
      
      
      
      


      for ($i=0; $i < $num_results; $i++) { 
        $row = $result->fetch_assoc();
        
        
        $IDres = $row['productID'];
        //echo $IDres;
        
        $name = $row['posterName'];
        //echo $name;
        
        $price = $row['price'];
        //echo $price;

        $image =  "./images/(".$row['productID'].").jpg";

        ?>
        
        <div class="card" style="width:300px">
		<form method="post" action="./customer_request/cart.php">
		<div ><img class="card-img-top" style="width:200px" src="<?php echo $image ?>"></div>
		<div class="product-tile-footer">
		<div class="card-body" align="bottom" ><?php echo $name ?></div>
		<div class="price"><?php echo "$".$price ?></div>
		<div class="card-footer" style="height:100px">
		    <input type="text" class="product-quantity" name="QTY" placeholder="0" required />
		    <input type = "hidden" name = "id" value = "<?PHP echo $IDres?>" />
            <input type = "hidden" name = "name" value = "<?PHP echo $name?>" />
            <input type = "hidden" name = "price" value = "<?PHP echo $price?>" />
		    <div class="d-grid gap-3"><input type="submit" value="Add to Cart" class="btn btn-success" /></div>
		    </div>
		</div>
		</form>
	    </div> 
	    

      <?PHP
      }
       disconnect($result,$db);
      ?>
      
      

</body>
</html>