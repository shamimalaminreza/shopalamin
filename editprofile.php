
<?php include 'inc/header.php';?>

<?php
//include 'lib/Session.php';
//if login is false it redirect into login page;

	$login=Session::get("cuslogin");
if ($login==false) {
header("Location:login.php");
}
?>
<style type="text/css">
	
.tblone{width: 550px;margin:0  auto; border: 2px solid #ddd;}
.tblone td ,tr{text-align: justify;}

.tblone input[type="text"]{width: 400px;padding: 5px;font-size: 15px;}
</style>


<!-- for taking value in submit from-->
<?php 
	$cmrId=Session::get("cmrId");
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])) {
//intelegence policy  
//for name $_POST is use and for image use $_FILES

$updatecmr=$cmr->customerUpdate($_POST,$cmrId);
}


?>

 <div class="main">
    <div class="content">
    	<div class="section group">

    	<?php 
//session ar maddome ami id ta dorlam
             $id=Session::get("cmrId");

             $getdata=$cmr->getCustomerData($id);
				  
				if ($getdata) {
				while ($result=$getdata->fetch_assoc()) {
    	       ?>



    	       <form action=""  method="post">
				<table class="tblone">

<!-- for showing customer profile-->
						<?php 

						if (isset($updatecmr)) {
							
                  echo "<tr><td colspan='2' style='width:400px;background:#EFEFEF;text-align:center;'>".$updatecmr."</td></tr>";

						}


						?>

					
                  <tr>
					<td colspan="2"><h2 style="text-align: center;">Update Profile Details</h2></td>
					
				</tr>



				<tr>
					<td width="20%">Name</td>
					
			<td><input type="text" name="name" value="<?php echo $result['name'];?>"></td>
				</tr>
				<tr>
					<td>Phone</td>
				
				<td><input type="text" name="phone" value="<?php echo $result['phone'];?>"></td>
				</tr>
				<tr>
					<td>Email</td>
					
				<td><input type="text" name="email" value="<?php echo $result['email'];?>"></td>
				</tr>
				<tr>
					<td>Address</td>
			<td><input type="text" name="address" value="<?php echo $result['address'];?>"></td>
				</tr>
				<tr>
					<td>City</td>
		<td><input type="text" name="city" value="<?php echo $result['city'];?>"></td>
				</tr>
				<tr>
					<td>Zipcode</td>
				
	<td><input type="text" name="zip" value="<?php echo $result['zip'];?>"></td>
				</tr>



				<tr>
				<td>Country</td>		
	<td><input type="text" name="country" value="<?php echo $result['country'];?>"></td>
				</tr>



					<tr>
					<td></td>
					<td><input type="submit" name="submit" value="Update"></td>			

					</tr>
				</table>
                </form>
				<?php }}?>

 		</div>
 	</div>
	</div>
   <?php include 'inc/footer.php';?>
