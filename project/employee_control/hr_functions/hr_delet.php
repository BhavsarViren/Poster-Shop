<?php 
        include "../../databaseConnection/database_connect.php";
        $db = connect();
        $employeeID = $_POST['employeeID'];
        $delet = "DELETE FROM `employee` WHERE `employee`.`employee_ID` = $employeeID";
        
        $delet_poster =  $db -> query($delet);
        // echo $delet;
        
        $db ->close();
        header("location: ../hr_pannel.php");
?>