<?php
// TODO: add here a way to acces only the employee accounts
// Verifying the passwords and username
require "../databaseConnection/database_connect.php";
//$eUser =  $_POST["emp_username"];
//$ePaswd = $_POST["emp_passwd"];
$db=connect();
$eUser = mysqli_real_escape_string($db, $_POST["emp_username"]); 
$ePaswd = mysqli_real_escape_string($db, $_POST["emp_passwd"]);

// echo $ePaswd."<br>".$eUser;




$sql = "SELECT `employee`.*, `employee_login`.*\n"

    . "FROM `employee` \n"

    . "	LEFT JOIN `employee_login` ON `employee_login`.`emp_id` = `employee`.`employee_ID`\n"

    . "    WHERE `emp_username` = \"$eUser\";";

// echo $sql;

// TODO: Return roles on current user
$result = $db->query($sql);
$num_results = $result->num_rows;
$row = $result->fetch_assoc();
$db_password =  $row['emp_password'];
$db_role =  $row['role'];
$db_user = $row ['first_Name'];




/*
this function is used to verify if our employee
it compares the $ePaswd value with the hashed password
in the database
function returns TRUE or FALSE
*/
password_verify($ePaswd,$db_password);
if (password_verify($ePaswd,$db_password) == TRUE) {
    // echo "verified";
    // echo $db_password."<br>".$db_role;
    // TODO: add a way so that depending on the roles we get a screen associated
    switch ($db_role) {
        // Human Resources
        case 'Human Resources':
            
            /* NEEDS: 
            View Accounts
            Make Accounts for employee
            */
            // we are using the header command here to direct into the page we need
            // NOTE: this is in this directory
            header("location: hr_pannel.php");
            break;
        // Product Manager 
        case 'Product Manager':
             header("location: product_manager_pannel.php");
           
            break;
        // Shipping Manager
        case 'Shipping Manager':
            header("location: shipping_manager_pannel.php");
            break;
        // Inventory Manager
        case 'Inventory Manager':
            header("location: inventory_manager_pannel.php");
            break;
        
        default:
            echo "either you are a customer or you somehow got here by accident pls get out";
            break;
    }

}
if (password_verify($ePaswd,$db_password) == FALSE) {
    echo "not verified please get out 😠";
}
// for($i=0; $i < $num_results;$i++){
//     $row = $result->fetch_assoc();
//     echo $row['emp_password'];
// }




 disconnect($result, $db);
?>