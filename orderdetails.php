<?php include 'inc/header.php';?>
<?php
//include 'lib/Session.php';
$login=Session::get("cuslogin");
if ($login==false) {
header("Location:login.php");
}
?>


<?php 

if (isset($_GET['customrId'])) {
$id=$_GET['customrId'];
$time=$_GET['time'];
$price=$_GET['price'];

$shift=$ct->productShiftConfirm($id,$time,$price);
        
}



?>



 <div class="main">
    <div class="content">
      
 <div class="section-group">

<div class="order">
  
<h2>Your Order Details</h2>

            <table class="tblone">
              <tr>
                  <th >No</th>
                <th >Product Name</th>
                <th >Image</th>             
                <th >Quantity</th>
                <th > Price</th>
                <th >Date</th>
                <th >Status</th>
                <th >Action</th>
              </tr>

               <!-- for showing of the list product in the database  table-->
                              <?php 
                              $cmrId=Session::get("cmrId");

                               $getOrder=$ct->getOrderProduct($cmrId);
                               if ($getOrder) {
                                  //for total price
                                $i=0;
                                while ($result=$getOrder->fetch_assoc()) {
                                 $i++;
                             
                                  ?>
                                <td><?php echo $i; ?></td>
                <td><?php echo $result['productName'];?></td>
                <td><img src="admin/<?php echo trim($result['image']);?>" alt=""/></td>
                <td><?php echo $result['quantity'];?></td>      
                  <td>Tk   <?php  echo $result['price'];?></td>


                            <td><?php echo $fm->formatDate($result['date']);?></td>

                      <td><?php 

                if ($result['status']=='0') {
              echo "Pending";
                }
                 elseif ($result['status']=='1') {

                  echo "Shifted";  

                   } else {

                         echo "OK";

                 }
            ?>              
            </td>



            <?php 
                      if ($result['status']=='1') {?>
                       <td><a href="?customrId=<?php echo $cmrId;?>&

                    price=<?php echo $result['price'];?>&time=<?php echo $result['date'];?>">Confirm</a>
                      </td>

                   <?php } elseif ($result['status']=='2') {?>
                       <td>OK</td>

                   <?php }elseif ($result['status']=='0') {?>
                          <td>N/A</td>
                        <?php }?>
        

        
              </tr>
              <?php  }} ?>

            </table>



            </div>



            </div>

       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php';?>
