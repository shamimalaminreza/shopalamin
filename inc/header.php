<?php 
 include 'lib/Session.php';
 Session::init();
 include 'lib/Database.php';
 include 'helpers/Format.php';
 //include '/../classes/Product.php';
//for all class automatic load
spl_autoload_register(function($class){
include_once "classes/".$class.".php";
});

//making object for database
$db=new Database();
$fm=new Format();
$pd=new Product();
$cat=new Category();
$ct=new Cart();
$cmr=new Customer();
?>


<!-- cash flow controlling-->
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>



<!DOCTYPE HTML>
<head>
<title><?php echo "Online Shopping  system";//TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top" style="background: ">
			<div class="logo" style="margin-top: -60px;">

							<a href="index.php"><img src="images/logo1.jpg" alt=""  style="width: ;height: 160px;margin-top: 32px;" /></a>

			</div>
			  <div class="header_top_right" style="margin-top: 39px;">

			    <div class="search_box">

                    <form action="search.php">
				<input type="text" value="Search for Products" name="search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
				    </form>

			    </div>

			    
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart</span>
								<span class="no_product">
								<?php 

                                   //method f check cat table data
                                  $getData=$ct->checkCartTable();

                                   if ($getData) {
                                   
                                //foor shng total amnt in cart option
                              $sum=Session::get("sum");
                              $qut=Session::get("qut");


                                 echo "Tk  ".$sum." | Qty:".$qut;

                                   }else{

                                   echo "(Empty)";   

                                   }
								?>

							</span>
							</a>
						</div>
			      </div>


                  <?php 
//for making customer logout
                 if (isset($_GET['cid'])) {
	                 $cmrId=Session::get("cmrId");
                 	//method for del cart data
                 	$delCartdata=$ct->delCartdata();
                    //mthod for del compare data
                    $delComp=$pd->delCompareData($cmrId);
                 	//if session destroy it tranferinto login page
                 	Session::destroy();

                 }
                  ?>

		   <div class="login">

           <?php 
          //for making logout option
           $login=Session::get("cuslogin");
           if ($login==false) {?>
		   	<a href="login.php">Login</a>
         <?php  }else {?>
		   	<a href="?cid=<?php Session::get("cmrId");?>">Logout</a>

              <?php }?>
		   </div>



		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu" style="background: #000;">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">

<?php
$login=Session::get("cuslogin");
if ($login==true) {?>
<?php }?>
 <li><a href="index.php">Home</a></li>
	  <li><a href="topbrands.php">Top Brands</a></li>


	  <?php 
	  //method for if cart is empty it not showw otherwise show
    $checkCart=$ct->checkCartTable();
		if ($checkCart) {?>
			 <li><a href="cart.php">Cart</a></li>
			 <li><a href="payment.php">Payment</a> </li>

	  <?php } ?>
	 



	  <?php 
	  //method for showing orderdtals card
	  $cmrId=Session::get("cmrId");
    $checkOrder=$ct->checkOrder($cmrId);
		if ($checkOrder) {?>
			 <li><a href="orderdetails.php">Order</a></li>

	  <?php } ?>

			<?php
//for showing customer profile page when customer is login
			 $login=Session::get("cuslogin");
            if ($login==true) {?>
            <li><a href="profile.php">Profile</a> </li>

           <?php }?>



				<?php 
             //when data is avalabl in compare table it show the meenu bar
                $cmrId=Session::get("cmrId");
               $getPd=$pd->getCompareData($cmrId);
               if ($getPd) {?>
               		  <li><a href="compare.php">Compare</a> </li>

			<?php } ?>
         
				<?php 
             //when data is avalabl in wishlist table it show the meenu bar
                $cmrId=Session::get("cmrId");
               $checkWlist=$pd->checkWishlistData($cmrId);
               if ($checkWlist) {?>
               		  <li><a href="wishlist.php">Wishlist</a></li>
			<?php } ?>


	  <li><a href="contact.php">Contact</a></li>
	   <li><a href="menu.php">Category</a> </li>

	  <div class="clear"></div>
	</ul>
</div>

