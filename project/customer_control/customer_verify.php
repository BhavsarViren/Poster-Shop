<?php 
//header('location: ../home.php');
// TODO: Password Checker + User Verify functions go here
session_start();
require "../databaseConnection/database_connect.php";
$db=connect();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Cart Page</title>
 

</head>
<body>
<?PHP

$email_address =  mysqli_real_escape_string($db, $_POST['email_address']);
$password = mysqli_real_escape_string($db, $_POST['password']);


$sql = "SELECT * FROM `customer_accounts` WHERE `email_address` = '$email_address' ";


$result = $db->query($sql);
$num_results = $result->num_rows;
$row = $result->fetch_assoc();
$db_password =  $row['password'];
$userACC = $row['email_address'];

//echo $db_password ." ".$password;



if (password_verify($password,$db_password)){
    
    $_SESSION['user'] = $userACC;
    $_SESSION['verify'] = TRUE;
    
    ?>
    <h1 align="center"> Welcome <?PHP echo $userACC;?></h1>
    <p align="center"><a href="../home.php" class="btn btn-primary">Enter!</a></p>
     <?PHP  
}
else{
    ?> 
    <h1 align="center"> INVALID </h1>
    <p align="center"><a href="customer_login.html" class="btn btn-danger">Try again</a></p>
    <?PHP
}

$db->close();

?>

</body>
</html>
