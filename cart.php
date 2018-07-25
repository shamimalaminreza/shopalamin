<?php include 'inc/header.php'; ?>

<?php 

//if user is not log in he can not access cart page
$login=Session::get('cuslogin');
if ($login==false) {
	header("Location:login.php");
}



?>


<?php 
//mthd frrr dltng carrt
if (isset($_GET['delpro'])) {
	$delId=$_GET['delpro'];
    $delProduct=$ct->delProductByCart($delId);
}
?>



<?php 
//for update cart option
if ($_SERVER['REQUEST_METHOD']=='POST') {

$cartId=$_POST['cartId'];	
$quantity=$_POST['quantity'];
$updateCart=$ct->updateCartQuantity($cartId,$quantity);
//whn quatty is smallrr than 0 it s dltd
if ($quantity<=0) {
	$delProduct=$ct->delProductByCart($cartId);
     //echo "The quantity value should be geater than 0 or -1";
   }
}
?>

<?php 
//cde for auto refresh  cartpage or for cart page auto relote
if (!isset($_GET['id'])) {
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";
}



?>

 <div class="main">

    <div class="content">
    	<div class="cartoption">	
			<div class="cartpage">
			    	<h2>Your Cart</h2>
                           <?php 
                          //fr shwing cart update message
                         if (isset($updateCart)) {
                         	echo $updateCart;
                         }

                         ?>	
                     

                         <?php 
                          //fr  cart deelete message
                         if (isset($delProduct)) {
                         	echo $delProduct;
                         }

                         ?>	


						<table class="tblone">
							<tr>

								<th width="5%">SL.No</th>
								<th width="30%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Quantity</th>
								<th width="10%">Total Price</th>
								<th width="10%">Action</th>

							</tr>

                           <?php 
                          //mthd f cat tn
                           
                           $getPro=$ct->getCartProdct();
                           if ($getPro) {
                           	$i=0;
                           	$sum=0;
                           	$qut=0;
                           
                           	while ($result=$getPro->fetch_assoc()) {
                           		$i++;
                           ?>
							<tr>
							    <td><?php echo $i;?></td>
								<td><?php echo $result['productName'];?></td>
								<td><img src="admin/<?php echo trim($result['image']);?>" alt=""/></td>
								<td>Tk  <?php echo $result['price'];?></td>
						      <td>
							<form action="" method="post">

					<input type="hidden" name="cartId" value="<?php echo $result['cartId'];?>"/>
					<input type="number" name="quantity" value="<?php echo $result['quantity'];?>"/>
					<input type="submit" name="submit" value="Update"/>
							</form>
						</td>


								<td>Tk  <?php 
								//fr get total pprice
					            $total=$result['price']*$result['quantity'];
     							echo $total;

								?></td>


<td><a onclick="return confirm('Are You  sure remove');" href="?delpro=<?php echo $result['cartId'];?>">X</a></td>


							</tr>

                             <?php 
                             //frr sub total valuee
                              $sum=$sum+$total;
                              $qut=$qut+$result['quantity'];
                            
                              //foor gttng total amont in cart opton
                              Session::set("sum",$sum);
                              Session::set("qut",$qut);
                           

                             ?>

							<?php }}?>
						</table>













                          <?php 
                             //showng cart data in cart table
                           $getData=$ct->checkCartTable();
                           if ($getData) {
                           
                          ?>

						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>Tk  <?php echo $sum;?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>Tk
									<?php 
                                     //fr vat including total amunt
                                     $vat=$sum*0.1;
                                     $gettotal=$vat+$sum;
                                     echo $gettotal;
									?>

								</td>
							</tr>
					   </table>

                       <?php }else{

                          
                       //echo "<p style='color:red'>Cart empty !Please Shop Now</p>";
                         //when cart is emty it rdect in index page
                       	header("Location:index.php");


                       }?>

					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>
