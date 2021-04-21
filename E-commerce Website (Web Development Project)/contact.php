<?php
session_start();
include 'inc/Config.php';
if (!isset($_GET['btnsb'])) {

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
        <li class="white"><a href="./">Home</a></li>

        <li><a href="./">Products</a></li>
        <li><a href="contact.php">Contact</a></li>

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php if (!$newuser->getSession()) {  ?>
        <li><a href="login"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
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
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart <span><?php if (isset($_SESSION['cart'])) {
          echo $_SESSION['cart'];
        } ?></span></a></li>
      </ul>
    </div>
  </div>
</nav>

<section id="" class="acrdion-main block-acrdion-main">
                                            <div class="acrdion-title">
                                                <h3 name="node-43">Customers</h3>
                                                <p><a href="javascript:void(0)"></a>
                                                </p>
                                            </div>
                                            <div class="panel-group ">

                                                <div class="panel panel-default">
                                                    <div class="panel-heading">



                                                    </div>
                
                                                </div>

                                                <div class="panel panel-default">
                                                    <div class="panel-heading">



                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="fbck " style="display: block;">

                                                                <p>Our customer service agents are there to help you daily between 8am to 10pm. Please have your order number handy for faster service </p>
                                                                <p><img src="https://static.daraz.pk/cms/2017/W32/contact-us/phone.png" class="indent_phone" alt="">
                                                                    (+92) 308 - 7921749</p>
                                                                <p><img src="https://static.daraz.pk/cms/2017/W32/contact-us/whatsapp.png" class="indent_phone" alt="">
                                                                    (+92) 308 7921749</p>
                                                              
                                                                <p>  <img src="https://static.daraz.pk/cms/2017/W32/contact-us/address.png" class="indent_mail" alt=""><p class="ti-body">12/B, 12th floor, rahman tower, hassan City, Plot # HC-3, Block 4,  sargodha road, Faisalabad</p>
                                                                </p>

                                                                <p><img src="https://static.daraz.pk/cms/2017/W32/contact-us/time.png" class="indent_phone" alt="">
                                                                    Operating Hours: Everyday from 9am to 11pm.</p>
                                                                <p> <img src="https://static.daraz.pk/cms/2017/W32/contact-us/mail.png" class="indent_mail" alt=""><p class="ti-body"><a href="/cdn-cgi/l/email-protection#6a091f191e05070f182a0e0b180b10441a01" target="_top">
                                                                <span class="__cf_email__" data-cfemail="fd9e888e899290988fbd999c8f9c87d38d96">[email&#160;protected]</span></a></p>

                                                                </p>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>




</div><br><br><br>


<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>  
  <form class="form-inline" method="get" action="index.php">Get deals:
    <input type="email" name="email" class="form-control" size="50" placeholder="Email Address">
    <button type="submit" name="btnsb" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>
</html>
<?php }else{

$email = $_GET['email'];

echo $email; 

} ?>