<?php include 'inc/header.php'; ?>

        <style type="text/css">
          .mybutton{width: 100px;float: left;margin-right: 50px;}

        </style>

 <div class="main">
    <div class="content">
      <div class="section group">
        <div class="cont-desc span_1_of_2"> 

                    
          <div class="grid images_3_of_2">

            <h2 style="text-align:  ; font-size: 30px; margin-left: 30px; text-transform: ; margin-top: 40px;color: green;">Here is product category</h1>
          </div>
        <div class="desc span_3_of_2">
          <div class="price">
       
          </div>

        <div class="add-cart">
               
        </div>

      
              <div class="add-cart">
                <div class="mybutton">

             </div>  
             <!--methd for wlisht-->
            <div class="mybutton">
             </div>
             </div>

      </div>


      <div class="product-desc">
      
      </div>
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
