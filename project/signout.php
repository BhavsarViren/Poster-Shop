<?php
   session_start();
   unset($_SESSION["user"]);
   unset($_SESSION["valid"]);
   $_SESSION = [];
   
   header('location: index.php');
?>