<?php
session_start();
 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Managment System</title>
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
      <a class="navbar-brand waves-effect" href="../" target="_blank">
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
            <a class="nav-link waves-effect" href="../">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="../" target="_blank">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link waves-effect" href="../contact.php" target="_blank">Contact</a>
          </li>
          
        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
          <li class="nav-item">
            <a class="nav-link waves-effect" href="../ca.php">
              <i class="fa fa-shopping-cart"></i>
              <span class="clearfix d-none d-sm-inline-block"> Cart </span><?php if (isset($_SESSION['cart'])) {
          echo $_SESSION['cart'];
        } ?>
            </a>
          </li>
          <?php if (!isset($_SESSION['user'])) {  ?>
          <li class="nav-item">
            <a href="../login" class="nav-link waves-effect" target="_blank">
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
                <li><a href="../user/?logout">Logout</a></li>
            </ul>
        </li>
      <?php } ?>
           
        </ul>

      </div>

    </div>
  </nav>
<main>
  <br>
  <br>
  <br>
  <br>
<div class="container">    
   <div class="container">
     <h2>Online Store</h2>
          <p>12/B, 12th floor, rahman tower, hassan City</p><p>Plot # HC-3, Block 4, sargodha road,</p><p>Faisalabad</p>
          <p>308 - 7921749</p>
   </div>
   <?php
   include 'db.php';
   include 'functions.php';
   $uid = $_SESSION['user'];

    $customer = new Customer($conn);
    $user = new User($conn);
    $ven = new Vendor($conn);
    $custo  = $customer->getCustomerDetails($uid);

    if($custo->num_rows > 0)
    {
    $r = $custo->fetch_assoc();

    $c_code = $r['C_code'];
    $fname = $r['C_Fname'];
    $lname = $r['C_Lname'];
    $Phone_no = $r['Phone_no'];
    $st = 0;
    $run = $user->getInvoice($c_code,$st);
     if ($run->num_rows > 0) 
     {
        while($invitem = $run->fetch_assoc()) 
        {
        $no = $invitem['INV_num'];
        $date = $invitem['INV_date'];
        $Sub_total = $invitem['Sub_total'];
        $amtotal = $invitem['Total'];
        $tax = $invitem['tax'];

         $usr = $ven->getVendor($uid);

        $address = $usr['V_address'];

        ?>
        <div class="jumbotron">
          
          <div class="btn btn-primary" style="width: 100%;">
            <p style="float: left;">Invoice No. <?php echo $no; ?></p>
            <p style="float: right;">Date: <?php echo $date; ?></p>
          </div>
          <br>
          <br>
          <div class="row">
            <div class="col-md-4">
              <b class="text text-primary">Name</b>
              <p><?php echo $fname . " " .$lname; ?></p>
            </div>
            <div class="col-md-4">
              <b class="text text-primary">Shiping To</b>
              <p><?php echo $address; ?></p>
            </div>
            <div class="col-md-4">
              <b class="text text-primary">Instructions</b>
              <p>None</p>
            </div>
          </div>
          <br>
          <br>
          <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <b>Sub Total. </b> <span>Rs. <?php echo " ".$Sub_total ?>/--</span>
              <br>
              <b>Tax. </b> <span>Rs. <?php echo " ".$tax ?>/--</span>
              <br>

              <b>Total. </b> <span>Rs. <?php echo " ".$amtotal ?>/--</span>
              <br>
              <br>
              <br>

              <span class="text">Thank you for shoping with us.</span>
            </div>
          </div>
        </div>
        <?php
      }
     }
     else
     {
        echo "Please buy some product";
     }

   }
   else
   {
      echo "No Invoice to pay.";
   }
   ?>
   
</div>
<div class="row productsdetails">
  <span class="text text-danger errors"></span>
  <input type="text" name="code" id="code" hidden>
  <div class="col-md-3">
    <h3 class="protital"></h3>
    <input type="text" class="form-control" name="noquantity" placeholder="Quantity" id="noquantity">
    <br>
     <button class="btn buyitem">Buy</button>
  </div>
</div>
</div><br><br>

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