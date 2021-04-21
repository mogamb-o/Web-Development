<?php
include '../inc/Config.php';

if($newuser->LogoutSession())
{
	header("Location:../");
}

?>