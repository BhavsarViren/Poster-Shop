<?php 
/* 
TODO: 
anti sql inject stuff
hash the password (see in /databaseConection/initial_sysadmin.php)
input to the actual database customer info

*/

require "../databaseConnection/database_connect.php";
$db = connect();

$firts_name = mysqli_real_escape_string($db, $_POST['first_name']);
$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
$zip_code = mysqli_real_escape_string($db, $_POST['zip_code']);
$street_name = mysqli_real_escape_string($db,$_POST['street_name']);
$state = mysqli_real_escape_string($db, $_POST['state']);
$city = mysqli_real_escape_string($db,  $_POST['city']);
$email_address = mysqli_real_escape_string($db, $_POST['email_address']);
$building_house_number = mysqli_real_escape_string($db, $_POST['building_house_number']);
$password = mysqli_real_escape_string($db, $_POST['password']);

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql ="INSERT INTO customer_accounts (firts_name, last_name, zip_code, street_name, state,
city, email_address, building_house_number, password)
VALUES ('$firts_name', '$last_name', '$zip_code', '$street_name', '$state',
'$city', '$email_address', '$building_house_number', '$hashed_password');";

$db->query($sql);


$db->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Welcome Page</title>
</head>
<body >
    <br/> 
    <br/>
    <div align="center" >
        <div class="card" style="width:500px; background-color:lightblue;">
            <h1>The Poster Shop</h1>
            <h2>Account has been created</h2>
            <div class="card-body">
            <a href="customer_login.html" class="btn btn-primary btn-lg">Sign in</a>
        </div>
    </div>
    
</body>
</html>