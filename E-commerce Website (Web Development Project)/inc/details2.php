<?php
session_start();
include 'db.php';
$account_balance = 30000;
$errors = array();

if (isset($_SESSION['user'])) 
{
   $uid = $_SESSION['user'];
  
  if (isset($_POST['submit'])) 
  {
     $name = $_POST['name'];
     $phoneno = $_POST['phoneno'];
     $adress = $_POST['adress'];
     $q = $conn->query("SELECT V_code FROM vendor ORDER BY V_code DESC LIMIT 1");
     $ro = $q->fetch_assoc();

     $V_code = $ro['V_code'];
     $V_code += 1;

     $vendor = "INSERT INTO vendor (V_code,user,V_name,V_contact,V_address) VALUES ('$V_code','$uid','$name','$phoneno','$adress')";

     $run = $conn->query($vendor);


     if ($run) 
     {
       
   $total = 0;
   
   $user = $_SESSION['user'];
   $query = "SELECT * FROM cart where userid='$user'";

   $run = $conn->query($query);

   if ($run->num_rows > 0) {
    // output data of each row
    while($row = $run->fetch_assoc()) {
  $newstack = 0;
  $cartid = $row['id']; 
   $code = $row['code'];   
  $qan = $row['quantities']; 

   $que = "SELECT Serial_No FROM purchase ORDER BY Serial_No DESC LIMIT 1";
   $getserial = $conn->query($que);
   $rr = $getserial->fetch_assoc();
   $serial_no = $rr['Serial_No'];
  $serial_no++;

  $get = "SELECT * FROM product where P_code='$code'";
  $request = $conn->query($get);

  $r = $request->fetch_assoc();

    $pcode = $r["P_code"];
   $P_quantity = $r["P_quantity"];
   $newstack = $P_quantity - $qan;
   $P_name = $r["P_name"];
   $P_price = $r["P_price"];
   $imgsrc = $r["p_img"];
   $P_description = $r["P_description"];
   

   $update = "UPDATE product SET P_quantity='$newstack' WHERE P_code='$code'";
   $conn->query($update);
   $subtotal = $qan * $P_price;
   $total +=$subtotal;
 

}

if ($total <= $account_balance) {
  
$ammount = "SELECT * FROM account where userid='$uid'";

$roww = $conn->query($ammount);
if ($roww->num_rows > 0) 
{
  $ammo = $roww->fetch_assoc();
$pre = $ammo['amount'];

$amount = $total + $pre;

$updateamount = "UPDATE account SET amount='$amount' Where userid='$uid'";
}
else
{
  $updateamount = "INSERT INTO account (userid,amount) VALUES ('$uid','$total')";
}


$conn->query($updateamount);

$customer = "SELECT C_code FROM customer where userid='$uid'";
$requ = $conn->query($customer);
 if ($requ->num_rows > 0) 
 {
      $user = $requ->fetch_assoc();
      $customer_code = $user['C_code'];
      $inv_date = date("Y-m-d");

      $createinvioce = "INSERT INTO invoice (C_code,INV_date,Sub_total,tax,Total) VALUES ('$customer_code','$inv_date','$total','0','$total')";

      if($conn->query($createinvioce))
      {
        $uid = $_SESSION['user'];
        $delcart = "DELETE FROM cart WHERE userid='$uid'";
        $conn->query($delcart);
        
        unset($_SESSION['cart']);
        $_SESSION['order'] = 1;

        header("Location:invoice.php");

      }
      else
      {
         array_push($errors,"Error occured try later.");
      }


 }
 else
  {
         array_push($errors,"User error.");
     
  }
}
else
{
  array_push($errors,"Balance is insufficient.");
}
}
else
{
         array_push($errors,"Cart is empty.");
    
}
  
     }
     else
     {
         array_push($errors,"Error occured try later.");
        
     }
}
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
  <?php
}
else
{
  header("Location:../login");
}

?>