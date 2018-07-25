
<?php include 'inc/header.php';?>


<!-- for searching in category page-->
<?php

if (!isset($_GET['search']) || $_GET['search']==NULL) {

//header("Location:404.php");
echo "please insert write keyword";
}
else{

$search= $_GET['search'];


}
 ?>


 <div class="main">
    <div class="content">
      <div class="content_top">
        <div class="heading">
        <h3>Feature Products</h3>
        </div>
        <div class="clear"></div>
      </div>



        <div class="section group">
          
        <?php
        //searching data from table
    //   $query="SELECT*FROM   table_cat WHERE catName LIKE '%$search%'";

        $query="SELECT*FROM   table_product WHERE  productName LIKE '%$search%' OR body LIKE '%$search%'";
        $post=$db->select($query);
        if ($post) {
        //for all post data fatching
        while ($result=$post->fetch_assoc()) {


         ?>

    <div class="grid_1_of_4 images_1_of_4">
<a href="details.php?proid=<?php echo $result['productId'];?>"><img src="admin/<?php echo trim($result['image']);?>" alt=""/></a>
       <h2><?php echo $result['productName'];?></h2>
       <p><?php echo $fm->textShorten($result['body'],60);?></p>
       <p><span class="price">Tk  <?php echo $result['price'];?></span></p>
 <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
    </div>
  
        <?php }}else{?>
<script>window.location="404.php"</script>
      <?php  }?>


    </div>

      <div class="content_bottom">
        <div class="heading">
        <h3>New Products</h3>
        </div>
        <div class="clear"></div>
         </div>
      <div class="section group">

              <?php   
//for fetching all feature product
          //$getNpd=$pd->getNewProduct();
             // if ($getNpd) {
               //while ($result=$getNpd->fetch_assoc()) {



        $query="SELECT*FROM   table_product WHERE  productName LIKE '%$search%' OR body LIKE '%$search%'";
        $getNpd=$db->select($query);
        if ($getNpd) {
while ($result=$getNpd->fetch_assoc()) {

          ?>

        <div class="grid_1_of_4 images_1_of_4">
<a href="details.php?proid=<?php echo $result['productId'];?>"><img src="admin/<?php echo trim($result['image']);?>" alt=""/></a>
       <h2><?php echo $result['productName'];?></h2>
       <p><span class="price">Tk  <?php echo $result['price'];?></span></p>
 <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
        </div>
        <?php }}else{?>
<script>window.location="404.php"</script>
      <?php  }?>
      </div>
    </div>
 </div>


  
   <?php include 'inc/footer.php';?>
