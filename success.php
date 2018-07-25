
<?php include 'inc/header.php';?>


<?php
//include 'lib/Session.php';
$login=Session::get("cuslogin");
if ($login==false) {
header("Location:login.php");
}
?>


<style type="text/css">
.psuccess{width: 500px;min-height: 200px;text-align: center;border: 1px solid #ddd;margin: 0 auto;padding: 50px;}
.psuccess h1{border-bottom: 1px solid #ddd;margin-bottom: 40px;padding-bottom: 10px}
.psuccess p{line-height: 25px;text-align: left;;font-size: 18px;}
</style>




 <div class="main">
    <div class="content">
    	<div class="section group">
         <div class="psuccess">
         	
		<h1 style="color: blue;">You are Successfully Ordered.You get Your Product  <?php 
        //$datetime = new DateTime();
        //$datetime->modify('+3 day');
        //echo $datetime->format('Y-m-d');
            echo "After 30 mins";

                    ?>
               </h1>
        

         <?php 
          //mthd for payable amount
         $cmrId=Session::get("cmrId");
         //method for payable amount by cmrId
         $amount=$ct->payableAmount($cmrId);
        if ($amount) {
        	$sum=0;
        while ($result=$amount->fetch_assoc()) {
        	$price=$result['price'];
        	$sum=$sum+$price;
        }
            }
         ?>


         <p>Total payable amount (including vat):Tk
         <?php 

		//for finding vat
		$vat=$sum * 0.1;
		$total=$vat+$sum;
		echo $total;
        ?>
         </p>
<p>Thanks for purchase.Receive Your order Successfully.We Will contact with you as soon as possible.with delivery details.Here your order details.....<a href="orderdetails.php">Visit Here......</a></p>

          </div>    
 		</div>
 	  </div>
	</div>
   <?php include 'inc/footer.php';?>
