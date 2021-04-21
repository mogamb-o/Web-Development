<?php

/**
 * products
 */
class Products
{
	private $conn = NULL;
	
  

	function __construct($conn)
	{
		$this->conn = $conn;
	}
	public function getProductBy_mainProductId($m_product_id)
	{
		$query = "SELECT * FROM product where main_product_id='$m_product_id'";

        return $this->conn->query($query);
	}
	public function main_products()
	{
		 $query = "SELECT * FROM main_product";

         return $this->conn->query($query);
	}
	public function getProduct()
	{
		$query = "SELECT * FROM product";

         return $this->conn->query($query);
	}
	public function selectProduct($code)
	{
		$get = "SELECT * FROM product where P_code='$code'";
        $request = $this->conn->query($get);
        return $request->fetch_assoc();
	}
	public function deleteCartItem($id)
	{
	 
	  $userid = $_SESSION['user'];
	  $delete = "DELETE FROM cart WHERE id='$id'";

	  $run = $this->conn->query($delete);

	  if ($run) 
	  {
	  	 $selectquery = "SELECT * FROM cart where userid='$userid'";
	  	   	  	  	 $runsel = $this->conn->query($selectquery);
	  	   	  	  	 $count = 0 ;
	  	   	  	  	 while($runsel->fetch_assoc())
	  	   	  	  	 {
	  	   	  	  	 	$count++;
	  	   	  	  	 }
	  	   	  	  	  
	  	   	  	  	 $_SESSION['cart'] = $count;

	  	   	  	  	
	  }
	  else
	  {
	  	echo "Error while deleting item from cart.";
	  }
	}
	public function BuyNow($code,$quantitysel)
	{
		 
	  	   $qu = "SELECT * FROM product Where P_code = '$code'";
	  	   $run = $this->conn->query($qu);

	  	   if ($run->num_rows > 0)
	  	   {
	  	   	  $row = $run->fetch_assoc();
	  	   	  $p_qu = $row['P_quantity'];
	  	   	  $userid = $_SESSION['user'];

	  	   	  if ($p_qu >= $_POST['quantity']) 
	  	   	  {
	  	   	  	  $insert = "INSERT INTO cart (userid,code,quantities) VALUES ('$userid','$code','$quantitysel')";

	  	   	  	  $request = $this->conn->query($insert);
	  	   	  	  if ($request) 
	  	   	  	  {
	  	   	  	  	 $selectquery = "SELECT * FROM cart where userid='$userid'";
	  	   	  	  	 $runsel = $this->conn->query($selectquery);
	  	   	  	  	 $count = 0 ;
	  	   	  	  	 while($runsel->fetch_assoc())
	  	   	  	  	 {
	  	   	  	  	 	$count++;
	  	   	  	  	 }
	  	   	  	  	 echo "Added to cart.";
	  	   	  	  	 echo $count;
	  	   	  	  	 $_SESSION['cart'] = $count;

	  	   	  	  }
	  	   	  	  else
	  	   	  	  {
	  	   	  	  	echo "Error while adding to cart.";
	  	   	  	  }
	  	   	  }
	  	   	  else
	  	   	  {
	  	   	  	echo "Quantity not available please enter less than ".$p_qu;
	  	   	  }

	  	   }
	  	   else
	  	   {
	  	   	  echo "Product don't exists in database";
	  	   }
	}
}

/**
 * Cart
 */
class Cart
{
	private $conn = NULL;
	private $p;
	public $account_balance = 30000;

	function __construct($conn)
	{
		$this->conn = $conn;
		$this->p = new Products($conn);
	}
	 
	public function customerDetails($name,$phoneno,$adress,$uid,&$errors)
	{
		
		 $q = $this->conn->query("SELECT V_code FROM vendor ORDER BY V_code DESC LIMIT 1");
		 $ro = $q->fetch_assoc();

		 $V_code = $ro['V_code'];
		 $V_code += 1;

		 $vendor = "INSERT INTO vendor (V_code,user,V_name,V_contact,V_address) VALUES ('$V_code','$uid','$name','$phoneno','$adress')";

		 $run = $this->conn->query($vendor);


		 if ($run) 
		 {
		 	 
   $total = 0;
   
   $user = $_SESSION['user'];
   $query = "SELECT * FROM cart where userid='$user'";

   $run = $this->conn->query($query);

if ($run->num_rows > 0) {
    // output data of each row
  while($row = $run->fetch_assoc()) {
  $newstack = 0;
  $cartid = $row['id']; 
   $code = $row['code'];   
  $qan = $row['quantities']; 

   $que = "SELECT Serial_No FROM purchase ORDER BY Serial_No DESC LIMIT 1";
   $getserial = $this->conn->query($que);
   $rr = $getserial->fetch_assoc();
   $serial_no = $rr['Serial_No'];
  $serial_no++;

  $r = $this->p->selectProduct($code);

    $pcode = $r["P_code"];
   $P_quantity = $r["P_quantity"];
   $newstack = $P_quantity - $qan;
   $P_name = $r["P_name"];
   $P_price = $r["P_price"];
   $imgsrc = $r["p_img"];
   $P_description = $r["P_description"];
   

   $update = "UPDATE product SET P_quantity='$newstack' WHERE P_code='$code'";
   $this->conn->query($update);
   $subtotal = $qan * $P_price;
   $total +=$subtotal;
 

}

if ($total <= $this->account_balance) {
  
$ammount = "SELECT * FROM account where userid='$uid'";

$roww = $this->conn->query($ammount);
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


$this->conn->query($updateamount);

$customer = "SELECT C_code FROM customer where userid='$uid'";
$requ = $this->conn->query($customer);
 if ($requ->num_rows > 0) 
 {
      $user = $requ->fetch_assoc();
      $customer_code = $user['C_code'];
      $inv_date = date("Y-m-d");

      if($this->createInvoice($customer_code,$inv_date,$total))
      {
      	$uid = $_SESSION['user'];
      	$this->delCart($uid);
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

	public function createInvoice($customer_code,$inv_date,$total)
	{
		$createinvioce = "INSERT INTO invoice (C_code,INV_date,Sub_total,tax,Total) VALUES ('$customer_code','$inv_date','$total','0','$total')";
		 
		return $this->conn->query($createinvioce);

	}
	public function delCart($uid)
	{
		$delcart = "DELETE FROM cart WHERE userid='$uid'";
      	return $this->conn->query($delcart);
	}
	public function getUserCart($user)
	{
		$query = "SELECT * FROM cart where userid='$user'";

         return $this->conn->query($query);
	}
}

/**
 * customerdetails
 */
class Customer
{
	
	private $conn = NULL;

	function __construct($conn)
	{
		$this->conn = $conn;
	}
	public function getCustomerDetails($uid)
	{
		$cu = "SELECT * FROM customer WHERE userid='$uid'";

       return $this->conn->query($cu);
	}
}

/**
 * USER
 */
class User 
{
	private $conn = NULL;
	function __construct($conn)
	{
		$this->conn = $conn;
	}
	public function getInvoice($c_code,$st)
	{
	 
     $inv = "SELECT * FROM invoice WHERE C_code='$c_code' AND status='$st'";
     return $run = $this->conn->query($inv);

    }
    public function setSession($username)
    {
    	$_SESSION['user'] = $username;
    }
    public function getSession()
    {
    	if(isset($_SESSION['user']))
    		return true;
    	return false;
    }

    public function Oauth($username,$password,&$errors)
    {
     $error = false;
	 if (empty($username))
	 {
	 	 $error = true;
	 	 array_push($errors, "Username Required.");
	 }
	 if (empty($password))
	 {
	 	 $error = true;
	 	 

	 	 array_push($errors, "Password Required.");
	 }

	 if ($error == false) 
	 {
	 	 $query = "SELECT * FROM s_login where Users_id='$username' AND Passwords='$password'";
	 	 $result = $this->conn->query($query);

         if ($result->num_rows > 0) 
         {
            $this->setSession($username);
            return true;
         } 
         else 
         {
         	    
         	array_push($errors, "Username or password invalid.");
         }
	 }
	 return false;
    	
    }

    public function passgenrator($length = 10) 
    {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randompass = '';
    for ($i = 0; $i < $length; $i++) {
        $randompass .= $characters[rand(0, $charactersLength - 1)];
    }
        return $randompass;
    }

    public function Register($_fname,$_lname,$_phno,&$errors,&$success)
    {
    	 $username = $_fname.$_lname;
    $username = strtolower($username);
    $cu = new Customer($this->conn);
    $run =  $cu->getCustomerDetails($username);

    if ($run->num_rows > 0) 
    {
       $username = $username.time();
    }
    $_pass = $this->passgenrator();

    $insert = "INSERT INTO customer (userid,C_Fname,C_Lname,Phone_no,Balance) VALUES ('$username','$_fname','$_lname','$_phno','0')";
    $user = "INSERT INTO s_login (Users_id,Passwords) VALUES ('$username','$_pass')";

    $up = $this->conn->query($insert);
    $in = $this->conn->query($user);

    if ($up) 
    {
        array_push($success, "You can login.");
        array_push($success, "Username: " . $username);
        array_push($success, "Password: " . $_pass);
    }
    else
    {
      array_push($errors, "Technical error.");
    }
    }
    public function LogoutSession()
    {
       session_start();
       unset($_SESSION['order']);
       unset($_SESSION['cart']);
	   unset($_SESSION['user']);
	   return true;
    }

}

/**
 * vendor
 */
class Vendor
{
	private $conn = NULL;

	function __construct($conn)
	{
		$this->conn = $conn;
	}
	public function getVendor($uid)
	{
		$ven = "SELECT * FROM vendor WHERE user='$uid' AND status='0'";
        $vendor  = $this->conn->query($ven);
        return $vendor->fetch_assoc();
	}
}


?>