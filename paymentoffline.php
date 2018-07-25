
<?php include 'inc/header.php';?>

<?php
//include 'lib/Session.php';
$login=Session::get("cuslogin");
if ($login==false) {
header("Location:login.php");
}
?>

<?php 
//method for order option
if (isset($_GET['orderid']) && $_GET['orderid']=='order') {
$cmrId=Session::get("cmrId");
$insertOrder=$ct->orderProduct($cmrId);
//when paymnt is complte the cart page is empty
$delCartdata=$ct->delCartdata();
//if cart data is deleted it redirect to success page
header("Location:success.php");
}
?>


<style type="text/css">

.division{width: 50%;float: left;}

.tblone {width: 500px;margin: 0 auto;border: 2px solid #ddd;}  
.tblone td,tr{text-align: justify;}
.tbltwo{float:right;text-align:left;width: 60%;border: 2px solid #ddd;margin-right: 14px;margin-top: 12px;}
.tbltwo td,tr{text-align: justify;padding: 5px 10px;}
.ordernow{padding-bottom: 30px;}
.ordernow a{width: 200px;margin:20px auto 0;text-align: center;padding: 5px;font-size: 30px;display: block;background: green;color: #fff;border-radius: 3px;}

</style>	


 <div class="main">
    <div class="content">
    	<div class="section group">
          <div class="division">
          	<table class="tblone">
							<tr>

								<th>No</th>
								<th>Product</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Total</th>

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
								<td>Tk  <?php echo $result['price'];?></td>
								<td><?php echo $result['quantity'];?></td>
								<td>Tk  <?php 
					            $total=$result['price']*$result['quantity'];
     							echo $total;

								?></td>
							</tr>

                             <?php 
                             //frr sub total valuee
                              $sum=$sum+$total;
                              $qut=$qut+$result['quantity'];
                             ?>
							<?php }}?>
						</table>
						<table class="tbltwo">
							<tr>
								<td>Sub Total</td>
								<td>:</td>
								<td>Tk  <?php echo $sum;?></td>
							</tr>
							<tr>
								<td>VAT</td>
								<td>:</td>
								<td>10%(Tk  <?php echo $vat=$sum*0.1;?>)</td>
							</tr>
							<tr>
								<td>Grand Total</td>
								<td>:</td>
								<td>Tk
									<?php 
                                     //fr vat including total amunt
                                     $vat=$sum*0.1;
                                     $gettotal=$vat+$sum;
                                     echo $gettotal;
									?>
								</td>
							</tr>

							<tr>
								<td>Quantity</td>
								<td>:</td>
								<td><?php echo $qut;?></td>
							</tr>
                            <button onclick="print();" style="margin-top: 150px; margin-left: 140px;">print</button>

					   </table>
                   </div>



          <div class="division">
    	   <?php 
           //session ar maddome ami id ta dorlam
    	   //sssn id is needed for developing customer profile
             $id=Session::get("cmrId");

             $getdata=$cmr->getCustomerData($id);
				  
				if ($getdata) {
				while ($result=$getdata->fetch_assoc()) {
    	       ?>
				<table class="tblone">
					
                  <tr>
					<td colspan="3"><h2 style="text-align: center;">Your Profile Details</h2></td>
					
				</tr>



				<tr>
					<td width="20%">Name</td>
					<td width="5%">:</td>
					<td><?php echo $result['name'];?></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td>:</td>
				<td><?php echo $result['phone'];?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td>:</td>
				<td><?php echo $result['email'];?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td>:</td>
				<td><?php echo $result['address'];?></td>
				</tr>
				<tr>
					<td>City</td>
					<td>:</td>
		        <td><?php echo $result['city'];?></td>
				</tr>
				<tr>
					<td>Zipcode</td>
					<td>:</td>
			<td><?php echo $result['zip'];?></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>:</td>
					<td><?php echo $result['country'];?></td>			
					</tr>
					<tr>
					<td></td>
					<td></td>
					<td><a href="editprofile.php">Update Details</a></td>			
					</tr>
				</table>
				<?php }}?>
          </div>
 		</div>
 	</div>
 	    <div class="ordernow"><a href="?orderid=order">Order</a></div>
	</div>
   <?php include 'inc/footer.php';?>
