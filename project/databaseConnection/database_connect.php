<?php
/*
we can use this file with a include or a require statement
so we can then just call the connect()
to get a connection to the database  
the disconnect() to disconnect
*/
function connect()
{
// Make sure to change this so that it matches what is in CPANEL
$db = new mysqli('localhost', 'deromav1_poster_shop_owner', 'iownthispostershop', 'deromav1_poster_shop');
return $db;
}

function disconnect($result,$db)
{
$result->free();
$db->close();
}?>