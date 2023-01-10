<?php 
require "./pdo_connect.php";
// README: This script was mainly use to initialize HR 


// dbc = connecting to database
//

$connection = connect();

function employee_account_add($dbc, $emp_name, $emp_password){

    /* This function allows to add the initial system Admin  
    step 1: make a connection to the database
    step 2: use php built in hashing function for the password
    step 3: we make a sql statement inserting it into the employee_accounts


    */
    $hashedPass = password_hash($emp_password, PASSWORD_DEFAULT);

    $sql_statement = "
    INSERT INTO `employee_login` (`emp_id`, `emp_username`, `emp_password`) VALUES ('2', '$emp_name', '$hashedPass')
    ";
    $sql_exec = $dbc -> prepare($sql_statement);
    $sql_exec -> execute();
    $sql_exec -> closeCursor();
}
// user:  virenb
// pass: humanresources
employee_account_add($connection,"virenb","humanresources");

?>
