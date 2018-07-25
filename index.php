

<?php include 'inc/header.php'; ?>
<?php include 'inc/slider.php'; ?>

<style type="text/css">
.pagination {
    display: block;
    font-size: 20px;
    text-align: center;
    margin-top: 20px;
    padding: 10px;
}
.pagination a {
    text-align: center;
    background: #D3576D;
    border: 1px solid #ddd;
    text-decoration: none;
    border-radius: 5px;
    padding: 2px 10px;
    color: #333;
    margin-left: 2px;
}
.pagination a:hover {
    background: #ddd;
    color: #000;
}
</style>


<?php  

$per_page=4;
if (isset($_GET["page"])) {
  
  $page=$_GET["page"];
}
else
{

  $page=1;
}
$start_from=($page-1)*$per_page;
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
//for fetching all feature product
           //$getFpd=$pd->getFeaturedProduct();
             // if ($getFpd) {
             // while ($result=$getFpd->fetch_assoc()) {
          ?>
<?php

$query="select * from table_product  WHERE type='0' limit $start_from,$per_page";
$getFpd=$db->select($query);
if ($getFpd) {
//for all post data fatching
while ($result=$getFpd->fetch_assoc()) {
 ?>
    <div class="grid_1_of_4 images_1_of_4">
<a href="details.php?proid=<?php echo $result['productId'];?>"><img src="admin/<?php echo trim($result['image']);?>" alt=""/></a>
       <h2><?php echo $result['productName'];?></h2>
       <p><?php echo $fm->textShorten($result['body'],60);?></p>
       <p><span class="price">Tk  <?php echo $result['price'];?></span></p>
 <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
    </div>
        <?php }?>
    </div>

        <?php 
$query="select*from  table_product";
$result=$db->select($query);
//for finding total row
$total_rows=mysqli_num_rows($result);
//find total pages
$total_pages=ceil($total_rows/$per_page);
echo "<span class='pagination'><a href='index.php?page=1'>".'<'."</a>";
for ($i=1; $i <= $total_pages; $i++) { 
  echo "<a href='index.php?page=".$i."'>".$i."</a>";
}
 echo "<a href='index.php?page=$total_pages'>".'>'."</a></span>"?>
<!-- pagination-->
<!-- redirect another page-->
<?php } else {   echo "<h1 class='pagination' style=color:red;>product not found</h1>";}//header("Location:404.php");}?>
<?php  

$per_page=4;
if (isset($_GET["page"])) {
  
  $page=$_GET["page"];
}
else
{
  $page=1;
}
$start_from=($page-1)*$per_page;
   ?>
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
              //if ($getNpd) {
               // while ($result=$getNpd->fetch_assoc()) {
          ?>
<?php

$query="select * from table_product WHERE type='1' limit $start_from,$per_page";
$getNpd=$db->select($query);
if ($getNpd) {
//for all post data fatching
while ($result=$getNpd->fetch_assoc()) {
 ?>
        <div class="grid_1_of_4 images_1_of_4">
<a href="details.php?proid=<?php echo $result['productId'];?>"><img src="admin/<?php echo trim($result['image']);?>" alt=""/></a>
       <h2><?php echo $result['productName'];?></h2>
       <p><span class="price">Tk  <?php echo $result['price'];?></span></p>
 <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
        </div>
        <?php }?>
      </div>


        <?php 
$query="select*from  table_product";
$result=$db->select($query);
//for finding total row
$total_rows=mysqli_num_rows($result);
//find total pages
$total_pages=ceil($total_rows/$per_page);
echo "<span class='pagination'><a href='index.php?page=1'>".'<'."</a>";
for ($i=1; $i <= $total_pages; $i++) { 
  echo "<a href='index.php?page=".$i."'>".$i."</a>";
}
 echo "<a href='index.php?page=$total_pages'>".'>'."</a></span>"?>
<!-- pagination-->
<!-- redirect another page-->
<?php } else {   echo "<h1 class='pagination' style=color:red;>product not found</h1>";}//header("Location:404.php");}?>
      </div>
    </div>
 </div>

<?php include 'inc/footer.php'; ?>
