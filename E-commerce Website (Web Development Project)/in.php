<?php

include 'inc/db.php';


$value = "c003";

$q = "INSERT INTO products (P_code) VALUES ('$value')";

if($conn->query($q))
{
	echo "doe";

}else
{
	echo "string";
}

?>