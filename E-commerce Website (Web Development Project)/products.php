<?php
session_start();
include 'inc/Config.php';
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
      <a class="navbar-brand waves-effect" href="" target="_blank">
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
            <a class="nav-link waves-effect" href="#">Home
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
            <a class="nav-link waves-effect" href="ca.php">
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



<br>
<br>
<br>
<br>
<br>

  <!--Main layout-->
  <main>
    <div class="container">

      <!--Navbar-->
      <nav class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 mb-5">

        <!-- Navbar brand -->
        <span class="navbar-brand">Categories:</span>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav"
          aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

          <!-- Links -->
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">All
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <?php
            $pro = new Products($conn);
$run = $pro->main_products();
   if ($run->num_rows > 0) {
    // output data of each row
    while($row = $run->fetch_assoc()) {
        
   $id = $row["id"];
   $cName = $row["name"];
   
  ?>
            <li class="nav-item">
              <a class="nav-link" href="products.php?id=<?php echo $id; ?>"><?php echo $cName; ?></a>
            </li>
<?php
   }
}
?>
          </ul>
          <!-- Links -->

          <form class="form-inline">
            <div class="md-form mt-0">
              <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            </div>
          </form>
        </div>
        <!-- Collapsible content -->

      </nav>
      <!--/.Navbar-->

      <!--Section: Products v.3-->
      <section class="text-center mb-4">

        <!--Grid row-->
        <div class="row wow fadeIn productsdiv">

          

            <?php
   
   $m_product_id = $_GET['id'];

   $run = $pro->getProductBy_mainProductId($m_product_id);

   if ($run->num_rows > 0) {
    // output data of each row
    while($row = $run->fetch_assoc()) {
        
   $code = $row["P_code"];
   $P_quantity = $row["P_quantity"];
   $P_name = $row["P_name"];
   $P_price = $row["P_price"];
   $imgsrc = $row["p_img"];
   $P_description = $row["P_description"];
  ?>

  <!--Grid column-->
          <div class="col-lg-3 col-md-6 mb-4">
            <!--Card-->
            <div class="card">

              <!--Card image-->
              <div class="view overlay">
                <img src="<?php echo $imgsrc; ?>" class="card-img-top" alt="">
                <a>
                  <div class="mask rgba-white-slight"></div>
                </a>
              </div>
              <!--Card image-->

              <!--Card content-->
              <div class="card-body text-center">
                 <center><strong><?php echo $P_description; ?></strong></center>
                <h5>
                  <strong>
                    <a href="" class="dark-grey-text"><?php echo $P_name; ?>
                      <span class="badge badge-pill danger-color"><?php echo $P_quantity; ?></span>
                    </a>
                  </strong>
                </h5>

                <h4 class="font-weight-bold blue-text">
                  <strong><?php echo $P_price; ?> PKR</strong>
                </h4>
                <button class="btn btn-info buynow" data-proid="<?php echo $code; ?>" data-protitle="<?php echo $P_name; ?>">BUY</button>
              </div>
              <!--Card content-->

            </div>
            <!--Card-->

          </div>
          <!--Grid column-->
<?php
   }
} else {
    echo "0 results";
}
?>
          

           

        </div>
        <!--Grid row-->

    <div class="row productsdetails">
  <span class="text text-danger errors"></span>
  <input type="text" name="code" id="code" hidden>
  <div class="col-md-3">
    <h3 class="protital"></h3>
    <input type="text" class="form-control" name="noquantity" placeholder="Quantity" id="noquantity">
    <br>
     <button class="btn btn-primary buyitem">Buy</button>
  </div>
</div>     

      </section>
      <!--Section: Products v.3-->

      

    </div>
  </main>
  <!--Main layout-->






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

  <script type="text/javascript">
  $('.buynow').click(function(){
           
           var code = $(this).data('proid');
           var title = $(this).data('protitle');
           $('.protital').text(title);
           $('#code').val(code);
           $('.productsdiv').hide();
           $('.productsdetails').show();
  });

  $('.buyitem').click(function(){
   var codeval = $('#code').val();
   var quantity = $('#noquantity').val();

             $.ajax({
   url: 'buy.php',
   type: 'POST',
   data: { codeval:codeval,quantity:quantity },
   success: function(response){
         $('.errors').text(response);
   }
  });
  });
</script>
</body>

</html>