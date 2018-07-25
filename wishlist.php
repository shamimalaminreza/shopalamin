<?php include 'inc/header.php'; ?>

<?php 

//if user is not log in he can not access wishlist page
$login=Session::get('cuslogin');
if ($login==false) {
	header("Location:login.php");
}

?>


<?php 

//method for remove wishlist product
if (isset($_GET['delwlistid'])) {
     $cmrId=Session::get("cmrId");
	$productId=$_GET['delwlistid'];
	$delWlist=$pd->delWlistData($productId,$cmrId);
}


?>

<?php 

//method for delete wlisht data
if (isset($delWlist)) {
	echo $delWlist;
}

?>




 <div class="main">

    <div class="content">
    	<div class="cartoption">	
           <h2>Product Wishlist</h2>
			<div class="cartpage">
					<table class="tblone">
							<tr>
								<th>SL.No</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Image</th>
								<th>Action</th>
							</tr>

                           <?php 
                          //mthd f cat tn
           
	                        $cmrId=Session::get("cmrId");
                           $getPd=$pd->checkWishlistData($cmrId);
                           if ($getPd) {
                           	$i=0;
                           	while ($result=$getPd->fetch_assoc()) {
                           		$i++;
                           ?>

							<tr>
							    <td><?php echo $i;?></td>
								<td><?php echo $result['productName'];?></td>
						      <td>$<?php echo $result['price'];?></td>
								<td><img src="admin/<?php echo trim($result['image']);?>" alt=""/></td>
								<td>

								<a href="details.php?proid=<?php echo $result['productId'];?>">Buy Now</a> ||
	<a onclick="return confirm('Are You Sure want to delete wishlist data');" href="?delwlistid=<?php echo $result['productId'];?>">Remove</a>

								</td>
							</tr>

							<?php }}?>
						</table>

					</div>
					<div class="shopping">
						<div class="shopleft" style="width: 100%;text-align: center;">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php'; ?>
