<?php 
include "../databaseConnection/database_connect.php";
$db = connect();
?>
<!doctype html>
<html lang='en'>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>HR Pannel</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi' crossorigin='anonymous'>
  </head>
  <body>


     <!-- header nav bar -->
    <div class='bg-dark text-center text-light'>
      <h1>Welcome to the HR Pannel</h1>
      <form action="logout_employee.php" method="post">
      <button type="submit" class="btn btn-warning mb-3">Logout 🚪</button>
      </form>
    </div>
    <!-- Employee Adder for Employee-->
    <h1 class="text-center">Employee Adder </h1>
      <div class="container" style="width:12rem">
    
        <form action="./hr_functions/hr_add.php" method="post" class="row g-3">
        <input type="text" class="form-control" name="first_name" placeholder="First Name">
        <input type="text" class="form-control" name="last_name" placeholder="Last Name">
        <select name="role" class="form-select">
        
        <!--  insert proper roles here -->
        <?php 
        
        $sql = "SELECT * FROM `employee_roles`;";

        $result = $db->query($sql);
        $num_results = $result->num_rows;

        for ($i=0; $i < $num_results; $i++) 
        { 
          $row = $result->fetch_assoc();
          $roles = $row['role_name'];
          $options_template = "<option value='$roles'> $roles </option>";
          echo $options_template;
        }
      

        ?>

        
        </select>
        <input type="text" class="form-control" name="username" placeholder="Employee userame">
        <input type="password" class="form-control" name="password" placeholder="Employee password">
        <button type="submit" class="btn btn-primary mb-3">Add </button>
        </form>
        
      </div>
      <!-- end of Employee Adder -->

    
    <!-- list of all employees -->
      <div class="container w-3 h-1" >
          <?php
            
            include "./hr_functions/hr_search.php"

            ?>
    </div>
    <!-- end of current employee table -->
    
   
    

  
    <?php
      disconnect($result,$db);
    ?>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3' crossorigin='anonymous'></script>
  </body>
</html>