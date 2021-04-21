<?php
session_start();

include 'inc/Config.php';


$success = array();
$errors = array();

if (isset($_POST['Signup'])) 
{
    $_fname = $_POST['fname'];
    $_lname = $_POST['lname'];
    $_phno = $_POST['ph'];

    $reg = $newuser->Register($_fname,$_lname,$_phno,$errors,$success); 
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Register</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Bootstrap core CSS -->
  <link href="https://mdbootstrap.com/previews/free-templates/ecommerce/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="https://mdbootstrap.com/previews/free-templates/ecommerce/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="https://mdbootstrap.com/previews/free-templates/ecommerce/css/style.min.css" rel="stylesheet">
  <style type="text/css">
    html,
    body,
    header,
    .carousel {
      height: 60vh;
    }

    @media (max-width: 740px) {
      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      html,
      body,
      header,
      .carousel {
        height: 100vh;
      }
    }

    .productsdetails
    {
      display: none;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand waves-effect" href="./" target="_blank">
        <strong class="blue-text">Online Store</strong>
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link waves-effect" href="./">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="./" target="_blank">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="contact.php" target="_blank">Contact</a>
          </li>
          
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="cart.php">
              <i class="fa fa-shopping-cart"></i>
              <span class="clearfix d-none d-sm-inline-block"> Cart </span><?php if (isset($_SESSION['cart'])) {
          echo $_SESSION['cart'];
        } ?>
            </a>
          </li>
          <?php if (!$newuser->getSession()) {  ?>
          <li class="nav-item">
            <a href="login" class="nav-link waves-effect" target="_blank">
               <span class="glyphicon glyphicon-user"></span> Your Account</a>
            </a>
          </li>
          <?php }else{ ?>
            <li> 
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['user']; ?></a>
            <ul class="dropdown-menu">
                 <?php if (isset($_SESSION['order'])) {
                  echo '<li><a href="inc/invoice.php">Invoice</a></li>';
                } ?>
                <li><a href="user/?logout">Logout</a></li>
            </ul>
        </li>
      <?php } ?>
           
        </ul>

      </div>

    </div>
  </nav>


    <!--Main layout-->
  <main>
    <div class="container">
      <br>
      <br>
      <br>
      <br>
      <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
          
          <h3>Signup</h3> 

          <span class="text text-success">
      <?php 
      foreach ($success as $key => $value) {
         echo $value."<br>";
      }

      ?>
    </span>
    <span class="text text-danger">
      <?php 
      foreach ($errors as $key => $value) {
         echo $value."<br>";
      }

      ?>
    </span>
     <form method="post" action="">
       <div class="form-group">
         <label>First Name</label>
         <input type="text" name="fname" class="form-control" placeholder="Name" required>
       </div>
       <div class="form-group">
         <label>Last Name</label>
         <input type="text" name="lname" class="form-control"  placeholder="Name" required>
       </div>
       <div class="form-group">
         <label>Phone No</label>
         <input type="text" name="ph" class="form-control"  placeholder="Phone Number" required>
       </div>
        <div class="form-group">
          
         <button style="display: inline-block;" type="submit" name="Signup" class="btn btn-primary">Register</button> <p style="display: inline-block;">OR<a href="login" > Login</a></p>
       </div>
     </form>
    


        </div>
        <div class="col-md-4"></div>
      </div>
    </div>

  </main>

  <!--Footer-->
  <footer class="page-footer text-center font-small mt-4 wow fadeIn">

 <br>
 <br>
 <br>

    <!-- Social icons -->
    <div class="pb-4">
      <a href="https://www.facebook.com/mdbootstrap" target="_blank">
        <i class="fa fa-facebook mr-3"></i>
      </a>

      <a href="https://twitter.com/MDBootstrap" target="_blank">
        <i class="fa fa-twitter mr-3"></i>
      </a>

      <a href="https://www.youtube.com/watch?v=7MUISDJ5ZZ4" target="_blank">
        <i class="fa fa-youtube mr-3"></i>
      </a>

      <a href="https://plus.google.com/u/0/b/107863090883699620484" target="_blank">
        <i class="fa fa-google-plus mr-3"></i>
      </a>

      <a href="https://dribbble.com/mdbootstrap" target="_blank">
        <i class="fa fa-dribbble mr-3"></i>
      </a>

      <a href="https://pinterest.com/mdbootstrap" target="_blank">
        <i class="fa fa-pinterest mr-3"></i>
      </a>

      <a href="https://github.com/mdbootstrap/bootstrap-material-design" target="_blank">
        <i class="fa fa-github mr-3"></i>
      </a>

      <a href="http://codepen.io/mdbootstrap/" target="_blank">
        <i class="fa fa-codepen mr-3"></i>
      </a>
    </div>
    <!-- Social icons -->

    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2018 Copyright:
      <a href="" target="_blank"> OnlineShop.pk</a>
    </div>
    <!--/.Copyright-->

  </footer>
  <!--/.Footer-->

  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Initializations -->
  <script type="text/javascript">
    // Animations initialization
    new WOW().init();
  </script>


</body>

</html>