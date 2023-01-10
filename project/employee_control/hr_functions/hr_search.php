
<div class="container text-center">
    <!-- add search bar to search by name -->
    <h1>Employee Search 🔍</h1>
    <form action="hr_pannel.php" method="post">
      <input type="text" name="emp_name_search" class="form-control p-1 mb-1">
      <button type="submit" class="btn btn-primary mb-3">Search 🔍</button>
    </form>
</div>
<div class="container w-3 h-1" >
        <h1 class="text-center">List of current Employee 📜</h1>
          
          <?php
            // by default the query will return all employee since there is no values to saerch
            // This set of querry searches via first name
            if (isset($_POST['emp_name_search']) == FALSE) 
            {
                // if the emp_name_search is empty return all employees
                $sql = "SELECT * FROM `employee` WHERE `first_Name` LIKE '%%';";
            }
            else
            {   
                // if the emp_name_search is not empty we return a like search
                $emp_search = $_POST['emp_name_search'];
                $sql = "SELECT * FROM `employee` WHERE `first_Name` LIKE '%$emp_search%';";
            }


            $result = $db->query($sql);
            $num_results = $result->num_rows;
            


            ?>
            <table class="table"> 
            <thead>
          <tr>
            <th scope="col">Employee ID</th>
            <th scope="col">Name</th>
            <th scope="col">Role</th>
          </tr>
        </thead>
        <tbody> 
        <?php
        // list all current employees      
        
        for ($i=0; $i < $num_results; $i++) 
        { 
          $row = $result->fetch_assoc();
          $emp_ID = $row['employee_ID'];
          $emp_fname = $row['first_Name'];
          $emp_lname = $row['last_Name'];
          $emp_role = $row['role'];
          $template = 
          "
          <tr>
          <th scope='row'>$emp_ID
          <form action='./hr_functions/hr_delet.php' method='post'>
                  <input type = 'hidden' name = 'employeeID' value = '$emp_ID' />
                  <button type='submit' class='btn btn-warning mb-3'>Delet This Employee ❌</button>
         </form>
          </th>
          <td>$emp_fname $emp_lname</td>
          <td>$emp_role</td>
          </tr>  
          <td>
                  
            </td>
          ";
          echo $template;
        }
        ?>
        </table>
        
      </tbody>
    </div>