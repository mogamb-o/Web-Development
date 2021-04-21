<?php
session_start();
include 'inc/Config.php';
$p = new Products($conn);

if ($newuser->getSession()) 
{
	  if (isset($_POST['codeval']) && isset($_POST['quantity'])) 
	  {
	  	 $p->BuyNow($_POST['codeval'],$_POST['quantity']);
	  }
	  else if(!isset($_POST['quantity']))
	  {
	  	echo "Quantity requiered!!";
	  }
	  else if(!isset($_POST['codeval']))
	  {
	  	echo "Code not found!!";
	  }
	  else
	  {
	  	echo "Quantity and code error!!";
	  }
}
else
{
	echo "Login to buy.";
}

?>