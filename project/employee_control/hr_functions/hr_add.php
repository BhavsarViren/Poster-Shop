<?php 
        include "../../databaseConnection/database_connect.php";
        $db = connect();
        if(isset($_POST['first_name']) == TRUE && isset($_POST['last_name']) == TRUE ){
            // setup varibales to add
        //$first_name = $_POST['first_name'];
        //$last_name = $_POST['last_name'];
        //$role_insert = $_POST['role'];
        //$emp_username = $_POST['username'];
        //$emp_passwordPlain = $_POST['password'];
        
        $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
        $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
        $role_insert = mysqli_real_escape_string($db, $_POST['role']);
        $emp_username = mysqli_real_escape_string($db, $_POST['username']);
        $emp_passwordPlain = mysqli_real_escape_string($db, $_POST['password']);
        
            // insert new employee
        $insert_employee = 
        "
        INSERT INTO `employee` (`first_Name`, `last_Name`, `employee_ID`, `role`) VALUES ('$first_name', '$last_name', NULL, '$role_insert');
        ";
        

        $result =  $db -> query($insert_employee);
        

            // select new employee ID based on first and last
        $select_ID_new_employee = "SELECT `employee_ID`  FROM `employee` WHERE `first_Name` LIKE '$first_name' AND `last_Name` LIKE '$last_name';";
        
        
            // save that employee ID to a variable
            $result = $db->query($select_ID_new_employee);
            $num_results = $result->num_rows;
            $row = $result->fetch_assoc();
            $new_emp_id  = $row['employee_ID'];

            

            // next we insert into the employee_login

        $hashedPass = password_hash($emp_passwordPlain, PASSWORD_DEFAULT);

        $insert_new_employee_login = 
        "
        INSERT INTO `employee_login` (`emp_id`, `emp_username`, `emp_password`) VALUES ('$new_emp_id', '$emp_username', '$hashedPass');
        ";
            
            $result =  $db -> query($insert_new_employee_login);

            // finaly lets go back to the page we were before

            header("location: ../hr_pannel.php");
        
        }


        else {
          echo "Nothing to add here keep moving";
        };


        // first we insert into employee
        // Then we take the new employee ID to use in the employee_login table
        // next we instert based on that

        
        
        

        



        
        // make sure to close 
        $db->close();
?>
