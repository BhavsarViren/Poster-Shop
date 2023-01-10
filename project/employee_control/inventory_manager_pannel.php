<?php 
include '../databaseConnection/database_connect.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inventory Manager Pannel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
      <!-- nav bar -->
  <div class='bg-dark text-center text-light'>
      <h1>Inventory Manger Pannel</h1>
        <form action="logout_employee.php" method="post">
      <button type="submit" class="btn btn-warning mb-3">Logout 🚪</button>
      </form>
    </div>
  <!-- adder for both categories and products -->
    <div class="containter w-3 h-1 text-center">
        <!-- product adder -->
        <div class="row justify-content-center">
          <div class="col">
          <h1>Add products ➕</h1>
          <!-- Adder for new products -->
          <form action="./inventory_function/inventory_adder.php" method="post">
            <label for="">Image orientation</label>
            <select name="orientation" id="" class="form-select">
              <option value="0">Landscape</option>
              <option value="1">Portrait</option>
            </select>
            <label for="">Image Color</label>
            <select name="image_color" id="" class="form-select">
              <option value="0">Black and White</option>
              <option value="1">Color</option>
            </select>

            <label for="">Category</label>
            <select name="category" id="" class="form-select">
            <?php
            $db = connect();
            // Here we are echoing all the categories found in our category table.
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
              // End of Products Adder
            ?>
            </select>
            <button type="submit" class="btn btn-primary mb-3">Add ➕</button>
          </form>
          </div>

           <!-- product Modify -->
           <div class="col">
             <h1 class="text-center"> Change Products Stock ⚙️</h1>
             <form action="./inventory_function/inventory_modify.php" method="post">
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
             <label for="">Change Stock</label>
             <input type="number" min='0' name="new_stockNumber" class="form-control p-1 mb-1">
              
            </select>
             
            <button type="submit" class="btn btn-warning mb-3">Modify ⚙️</button>
             </form>
           </div>

            <!-- adder for categories -->
          <div class="col">
            <h1>Category adder</h1>
            <form action="./inventory_function/inventory_category_add.php" method="post">
            <label for="">New Category</label>

            <input type="text" name="new_category_name" class="form-control p-1 mb-1" required>
            <button type="submit" class="btn btn-primary mb-3">Add ➕</button>
            </form>
          </div>
        </div>
        
    </div>


    <!-- List of all items in inventory -->
    <div class="container w-2">
      <h1 class="text-center">List of our products</h1>

    
    <table class="table"> 
        <thead>
          <tr>
            <th scope="col">product ID</th>
            <th scope="col">Color Profile</th>
            <th scope="col">Orientation</th>
            <th scope="col">category</th>
            <th scope="col">Quantity</th>
            <th scope="col">Picture</th>
          </tr>
        </thead>

        <tbody> 
        <?php 

        $sql = "SELECT `inventory`.*, `poster`.*\n"

        . "FROM `inventory` \n"
    
        . "	LEFT JOIN `poster` ON `inventory`.`productID` = `poster`.`productID`\n";

        $result = $db->query($sql);
        $num_results = $result->num_rows;

        for ($i=0; $i < $num_results; $i++) 
        { 
            $row = $result->fetch_assoc();
            $productID = $row['productID'];
            $color = $row['color_profile'];
            $orientation = $row['orientation'];
            $category = $row['category'];
            $qty = $row['quantity'];
            
    
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
                  <th>$productID</th>
                  <td>$color</td>
                  <td>$orientation</td>
                  <td>$category</td>
                  <td>$qty</td>
                  <td>
                  <div class='card m-1' style='width: 10rem;'>
                  <img src='../images/($productID).jpg' class='card-img-top' alt='...'>
                  </div>
                  </td>
                  <td>
                  <form action='./inventory_function/inventory_delet.php' method='post'>
                  <input type = 'hidden' name = 'product_ID_delet' value = '$productID' />
                  <button type='submit' class='btn btn-warning mb-3'>Delet This Product ❌</button>
                    </td>
                  </tr>  
                  ";
            echo $template;
        }
        
        
        ?>
        </tbody>
                
        </table>
    </div>

    <!-- end of products list here -->

    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>

<?php 
// remember to close it. :]
disconnect($result,$db);
?>
