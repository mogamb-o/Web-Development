<?php


session_start();
include 'db.php';
include 'functions.php';
$c = new Cart($conn);
$errors = array();

if (isset($_SESSION['user'])) 
{
	 $uid = $_SESSION['user'];
	
	if (isset($_POST['submit'])) 
	{
    $name = $_POST['name'];
     $phoneno = $_POST['phoneno'];
     $adress = $_POST['adress'];
     $c->customerDetails($name,$phoneno,$adress,$uid,$errors);

	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Managment System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default rounded borders and increase the bottom margin */ 
    .navbar {
      margin-bottom: 50px;
       background-color: crimson;
      border-radius: 0;
    }
    
    /* Remove the jumbotron's default bottom margin */ 
     .jumbotron {
      margin-bottom: 0;
    }
   
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: crimson;
      padding: 25px;
    }
    .productsdetails
    {
      display: none;
    }
  </style>
</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <h1 style="color:black;">Online Store</h1>  
    <p style="color:crimson;">Their you gona a find your stuff</p>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="white"><a href="../">Home</a></li>

        <li><a href="../">Products</a></li>
        <li><a href="../contact.php">Contact</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if (!isset($_SESSION['user'])) {  ?>
        <li><a href="../login"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
      <?php }else{ ?>
        <li> 
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user']; ?></a>
            <ul class="dropdown-menu">
                 <?php if (isset($_SESSION['order'])) {
                  echo '<li><a href="invoice.php">Invoice</a></li>';
                } ?>
                <li><a href="../user/?logout">Logout</a></li>
            </ul>
        </li>
      <?php } ?>
        <li><a href="../cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span><?php if (isset($_SESSION['cart'])) {
          echo $_SESSION['cart'];
        } ?></span></a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">  
  <div class="row">
<div class="col-md-6">
  <span class="text text-danger">
  <?php foreach ($errors as $key => $value) 
  {
     echo $value;
  } ?></span>
<form class="form" action="" method="POST">
	<div class="form-group">
		<label>Name* </label>
		<input type="text" name="name" class="form-control" placeholder="Your Name" required>
	</div>
	<div class="form-group">
		<label>Phone No* </label>
		<input type="text" name="phoneno" class="form-control" placeholder="+923 - - - - - - -" required>
	</div>
	<div class="form-group">
		<label>Address* </label>
		<input type="text" name="adress" class="form-control" placeholder="Shiping address" required>
	</div>
	<div class="form-group">
		<input type="submit" name="submit" class="btn btn-info" value="Order">
	</div>


</form>
  </div>
  </div>
</div><br><br>

<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>  
  <form class="form-inline" method="get" action="index.php">Get deals:
    <input type="email" name="email" class="form-control" size="50" placeholder="Email Address">
    <button type="submit" name="btnsb" class="btn btn-danger">Sign Up</button>
  </form>
</footer>


 
</body>
</html>

<?php
}
else
{
	header("Location:../login");
}

?>