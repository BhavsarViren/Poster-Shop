<?php 
include "../databaseConnection/database_connect.php";
$db = connect();
?>
<!doctype html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Shipping manager</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi' crossorigin='anonymous'>
  </head>
  <body>


     <!-- header nav bar -->
    <div class='bg-dark text-center text-light'>
      <h1>Shipping manager </h1>
      <form action="logout_employee.php" method="post">
      <button type="submit" class="btn btn-warning mb-3">Logout 🚪</button>
      </form>
    </div>
    <?php
    
    /*  
    SELECT `customer_accounts`.`firts_name`,`last_name`, `zip_code`,`street_name`,`state`,`building_house_number`,`city` ,`customer_order`.* FROM `customer_accounts` LEFT JOIN `customer_order` ON `customer_order`.`email_address` = `customer_accounts`.
    `email_address` WHERE `customer_order`.`email_address` = "t2@test.com"     
    be sure to mod the email above to suite.
    */
    ?>

      
        <?php 
        
        // selects all of inventory table   

        // $sql = "SELECT * FROM `poster`;";

        

        // $get_email = "SELECT `email_address` FROM `customer_accounts`";
        
        
        /*
        SQL FOR this is basically
        we join both customer_accounts and customer orders
        where shipping status is not NULL
        meaning that the customer has made an order in

        */
    
    $sql = "SELECT `customer_accounts`.`firts_name`,`last_name`, `zip_code`,`street_name`,`state`,`building_house_number`,`city` ,`customer_order`.* FROM `customer_accounts` LEFT JOIN `customer_order` ON `customer_order`.`email_address` = `customer_accounts`.`email_address` \n"

    . "\n"

    . "WHERE `shipping_status` IS NOT NULL AND `shipping_status`= 0 ORDER BY `customer_order`.`email_address`";
    
    // echo $sql;


        /**
         * SHow the following
         * Customer Email
         * Customer Address
         * Shipping Status
         * 
         */
        
         $result = $db->query($sql);
         $num_results = $result->num_rows;
         for ($i=0; $i < $num_results; $i++) 
         { 
           
         

         $row = $result->fetch_assoc();
         $customerEmail = $row['email_address'];
         $productName = $row['pName'].", ";
         $productID = $row['product_ID'];
         $productQTY = $row['QTY'] ;
         $orderTime = $row['date'] ;
         $orderID = $row['orderID'];

        $table_header = "
          
          <table class='table'> 
            <thead>
            <tr>
            
            <tr>

          ";
          $table_closer = "
          </thead>

        <tbody> 
        </tbody>
                
        </table>
          ";
         $template = 
            "
            
            <td>PID: $productID</td>
            <td>:Quantity $productQTY</td>
            <td>Ordered: $orderTime </td>
            
            <td>
            <div class='card m-1' style='width: 10rem;'>
            <img src='../images/($productID).jpg' class='card-img-top' alt='...'>
            </div>
            </td>
            <td>
            <form action='./shipping_function/shipping_modifier.php' method='post'>
            <input type = 'hidden' name = 'oderID' value = '$orderID' />
            <button type='submit' class='btn btn-warning mb-3'>Shipped 🚛</button>
            </form>
            </td>
            
        
            ";
        $customer_title = "<h1> $customerEmail</h1>";
            
        
        if ($i == 0) {
            
            echo $customer_title;
            
            
            // echo $template;
        }
        
        if ($i > 0 && $customerEmail != $prev_customer_email) {
            echo $customer_title;
            
            
            
        }
        if ($i > 0 && $customerEmail == $prev_customer_email) {
            
            // echo $template;
            // echo $productName;
        }
        
        echo $table_header;
        echo $template;
        echo $table_closer;
            


        

        


         $prev_customer_email = $customerEmail;
         
         }
        
            
            
        
        
        
        ?>
        
            

    
            
          
    </div>
    
    <?php
      disconnect($result,$db);
    ?>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3' crossorigin='anonymous'></script>
  </body>
</html>