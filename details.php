<?php include 'inc/header.php'; ?>



<?php 

if (isset($_GET['proid'])) {
  // echo "<script>window.location='404.php';</script>";
$id=$_GET['proid'];
}

/*$brand=new Brand();*/
//working wwith cart option

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) {
$quantity=$_POST['quantity'];
$addCart=$ct->addToCart($quantity,$id);
}
?>



<?php 
//method for insert compare data
$cmrId=Session::get("cmrId");
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['compare'])) {
//intelegence policy  
//for name $_POST is use and for image use $_FILES
$productId=$_POST['productId'];

$insertCom=$pd->insertCompareData($productId,$cmrId);
}

?>



<?php 
//method for wishlist  data
$cmrId=Session::get("cmrId");
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['wlist'])) {
$saveWlist=$pd->saveWishListData($id,$cmrId);
}

?>




        <style type="text/css">
          .mybutton{width: 100px;float: left;margin-right: 50px;}


        </style>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	

                     <?php 

                     //mthod for gt sngl 
                  $getPd=$pd->getSingleProduct($id);
                  if ($getPd) {
                  	while ($result=$getPd->fetch_assoc()) {
                     ?>


					<div class="grid images_3_of_2">
						<img src="admin/<?php echo trim($result['image']); ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?></h2>	
					<div class="price">
				<p>Price: <span>Tk  <?php echo $result['price']; ?></span></p>
        <p>Old Price: <span style="text-decoration-line: line-through;">Tk  <?php echo $result['oldprice']; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>



				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>				
				</div>

        
             <span style="color:red; font-size: 18px;">
                 	<?php  
                      //fr shwing addd mssage
                   if (isset($addCart)) {
                   	echo $addCart;
                   }                
                	?>

                  



                  </span>


                   <?php  
                      //fr shwing addd mssage
                   if (isset($insertCom)) {
                    echo $insertCom;
                   }
                 
                  ?>

                    <?php 

                     //method for save wilishlist page
                    if (isset($saveWlist)) {
                      echo $saveWlist;
                    }


                    ?>



              <?php 

               //when user is lg in he can see details of the page
                $login=Session::get("cuslogin");
                if ($login==true) {

              ?>
              <div class="add-cart">
                <div class="mybutton">

             <form action="" method="post">
          <input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId'];?>"/>
            <input type="submit" class="buysubmit" name="compare" value="Add to compare"/>
             </form>  
             </div>  
             <!--methd for wlisht-->


            <div class="mybutton">
            <form action="" method="post">
            <input type="submit" class="buysubmit" name="wlist" value="Save  to list"/>
             </form> 
             </div>
             </div>

             <?php }?>
			</div>


			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $result['body']; ?>
	    </div>
			<?php }}?>
	     </div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>



					<ul>

                    <?php 
                    //showing category from category tabale
                    $getCat=$cat->getAllCat();
                    if ($getCat) {
                    	
                    	while ($result=$getCat->fetch_assoc()) {
                    		
                        ?>
	 <li><a href="productbycat.php?catId=<?php echo $result['catId'];?>"><?php echo $result['catName'];?></a></li>
                      <?php }}?>
				   
    				</ul>
    	
 				</div>
 		</div>
 	</div>
	</div>
   <?php include 'inc/footer.php'; ?>
