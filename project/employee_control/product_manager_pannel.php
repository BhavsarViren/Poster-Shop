<?php 
include '../databaseConnection/database_connect.php';
$db = connect();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Manger Pannel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
      <!-- nav bar -->
  <div class='bg-dark text-center text-light'>
      <h1>Product Manger Pannel</h1>
      <form action="logout_employee.php" method="post">
      <button type="submit" class="btn btn-warning mb-3">Logout 🚪</button>
      </form>
    </div>
  <!-- modiy forms -->

             
             <div class="container w-1">
             <h1 class="text-center"> Modify Products ⚙️</h1>
             <form action="./product_functions/product_modify.php" method="post">
               Select Product ID
             <select name="productID" id="productID" class="form-select p-1 mb-1">
              <?php
                $sql = "SELECT * FROM `poster`;";
                $result = $db->query($sql);
                $num_results = $result->num_rows;
                for ($i=0; $i < $num_results; $i++) 
                { 
                $row = $result->fetch_assoc();
                $list_productID = $row['productID'];

                
                $PID_lists = "<option value='$list_productID'>$list_productID</option>";
                echo $PID_lists; 
                }
              ?>

              
             </select>
             <label for="">Image Color</label>
            <select name="image_color" id="" class="form-select">
              <option value="0">Black and White</option>
              <option value="1">Color</option>
            </select>
             <label for="">Image orientation</label>
            <select name="orientation" id="" class="form-select">
              <option value="0">Landscape</option>
              <option value="1">Portrait</option>
            </select>
            <label for="">Change Category</label>
            <select name="category" id="category" class="form-select p-1 mb-1">
              <?php 
              
              $sql = "SELECT * FROM `poster_category`;";
        
            $result = $db->query($sql);
            $num_results = $result->num_rows;
            // echo all categories to then be used in an insert statement later
            for ($i=0; $i < $num_results; $i++) 
            { 
            $row = $result->fetch_assoc();
            $category_options = $row['category'];
            $category_list = "<option value='$category_options'>$category_options</option>"  ;
            echo $category_list;
            }
              // End of product Modify
              ?>
            </select>
            Rename Poster
            <input type="text" name="new_title" class="form-control p-1 mb-1">
            Change Price of poster
            <input type="text" name="new_price" class="form-control p-1 mb-1">
            

            <label for="">Change Visibility</label>
            <select name="new_visibility" id="" class="form-select">
              <option value="0">Invisible</option>
              <option value="1">Vissible</option>
            </select>
            <button type="submit" class="btn btn-warning mb-3">Modify ⚙️</button>
             </form>
           </div>



    <div class="container">
      <div class="row">
        <div class="col">
          <h1 class="text-center">List of Visible Products</h1>
          <div class="container overflow-auto">
      

    <table class="table"> 
        <thead>
          <tr>
            <th scope="col">product ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Color Profile</th>
            <th scope="col">Orientation</th>
            <th scope="col">category</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Picture</th>
            
          </tr>
        </thead>

        <tbody> 
        <?php 
        
        // selects all of inventory table

        // $sql = "SELECT * FROM `poster`;";

        $sql = "SELECT `inventory`.*, `poster`.*\n"

      . "FROM `inventory` \n"
  
      . "	LEFT JOIN `poster` ON `inventory`.`productID` = `poster`.`productID`\n"
  
      . "    WHERE `visibility` = 1;";

        $result = $db->query($sql);
        $num_results = $result->num_rows;

        for ($i=0; $i < $num_results; $i++) 
        { 
            $row = $result->fetch_assoc();
            $productID = $row['productID'];
            $color = $row['color_profile'];
            $orientation = $row['orientation'];
            $category = $row['category'];
            $quantity = $row['quantity'];
            $price = $row['price'];
            $name = $row['posterName'];

            
    
        // make a statement so that if colorporfile == 1
        // echo color else echo black n white
    
        // same goes for the orientation
        // 0 == Landscape 1 == portrait
        // 0 == Color 1 = Color
    
            if ($color == 0) {
                $color = "Black and White";
            }
            else {
                $color = "Color";
            }
            if ($orientation == 0) {
                $orientation = "Landscape";
            }
            else {
                $orientation = "Portrait";
            }
            
            $template = 
                  "
                  <tr>
                  <td>$productID</td>
                  <td>$name</td>
                  <td>$color</td>
                  <td>$orientation</td>
                  <td>$category</td>
                  <td>$quantity</td>
                  <td>$price</td>
                  <td>
                  <div class='card m-1' style='width: 10rem;'>
                  <img src='../images/($productID).jpg' class='card-img-top' alt='...'>
                  </div>
                  </td>



                  </tr>  
                  ";
            echo $template;
        }
        
        
        ?>
        </tbody>
                
        </table>
    </div>

        </div>
        <!-- here lets list all invisible products -->
        <div class="col">
        <h1 class="text-center">Invisible</h1>
        <table class="table"> 
        <thead>
          <tr>
            <th scope="col">product ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Color Profile</th>
            <th scope="col">Orientation</th>
            <th scope="col">category</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Picture</th>
            
          </tr>
        </thead>

        <tbody> 
        <?php 
        $db = connect();
        // selects all of inventory table

        // $sql = "SELECT * FROM `poster`;";

        $sql = "SELECT `inventory`.*, `poster`.*\n"

      . "FROM `inventory` \n"
  
      . "	LEFT JOIN `poster` ON `inventory`.`productID` = `poster`.`productID`\n"
  
      . "    WHERE `visibility` = 0;";

        $result = $db->query($sql);
        $num_results = $result->num_rows;

        for ($i=0; $i < $num_results; $i++) 
        { 
            $row = $result->fetch_assoc();
            $productID = $row['productID'];
            $color = $row['color_profile'];
            $orientation = $row['orientation'];
            $category = $row['category'];
            $quantity = $row['quantity'];
            $price = $row['price'];
            $name = $row['posterName'];

            
    
        // make a statement so that if colorporfile == 1
        // echo color else echo black n white
    
        // same goes for the orientation
        // 0 == Landscape 1 == portrait
        // 0 == Color 1 = Color
    
            if ($color == 0) {
                $color = "Black and White";
            }
            else {
                $color = "Color";
            }
            if ($orientation == 0) {
                $orientation = "Landscape";
            }
            else {
                $orientation = "Portrait";
            }
            
            $template = 
                  "
                  <tr>
                  <td>$productID</td>
                  <td>$name</td>
                  <td>$color</td>
                  <td>$orientation</td>
                  <td>$category</td>
                  <td>$quantity</td>
                  <td>$price</td>
                  <td>
                  <div class='card m-1' style='width: 10rem;'>
                  <img src='../images/($productID).jpg' class='card-img-top' alt='...'>
                  </div>
                  </td>



                  </tr>  
                  ";
            echo $template;
        }
        
        
        ?>
        </tbody>
                
        </table>
        </div>
      </div>
    </div>

    <!-- List of all items in inventory -->
    
    <!-- end of products list here -->

    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>

<?php 
// remember to close it. :]
disconnect($result,$db);
?>
