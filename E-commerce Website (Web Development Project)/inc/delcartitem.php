<?php
session_start();

include 'db.php';
include 'functions.php';
$p = new Products($conn);

if (isset($_POST['delitemid']) && isset($_SESSION['user'])) 
{
	 $p->deleteCartItem($_POST['delitemid']);
}
else if(!isset($_POST['delitemid']))
{
	echo "Product id not found!!";
}
else if(!isset($_SESSION['user']))
{
   echo "Please login!!";
}
else
{
	echo "Product ID and Login not found.";
}

?>