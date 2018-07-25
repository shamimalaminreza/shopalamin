<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">

                     <?php 


                      //mthd fr brand add in front view
                     $getIphone=$pd->latestFromIphone();
                         if ($getIphone) {
                         	while ($result=$getIphone->fetch_assoc()) {
                         	
                     ?>

				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
<a href="details.php?proid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo trim($result['image']); ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Xiaomi</h2>
						<p><?php echo $result['productName']; ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>	
                 <?php }}?>




                     <?php 


                      //mthd fr brand add in front view
                     $getSamsung=$pd->latestFromSamsung();
                         if ($getSamsung) {
                         	while ($result=$getSamsung->fetch_assoc()) {
                         	
                     ?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">


	<a href="details.php?proid=<?php echo $result['productId'];?>"><img src="admin/<?php echo trim($result['image']); ?>" alt="" / ></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Clock</h2>
						  <p><?php echo $result['productName']; ?></p>
	 <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
					</div>
				</div>

				<?php }}?>
			</div>



                     <?php 


                      //mthd fr brand add in front view
                     $getAcer=$pd->latestFromAcer();
                         if ($getAcer) {
                         	while ($result=$getAcer->fetch_assoc()) {
                         	
                     ?>


			<div class="section group">
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
	 <a href="details.php?proid=<?php echo $result['productId'];?>"> <img src="admin/<?php echo trim($result['image']); ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Boiler </h2>
						<p><?php echo $result['productName']; ?></p>
	<div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
				   </div>
			   </div>	
                  <?php }}?>



                          <?php 


                      //mthd fr brand add in front view
                     $getCanon=$pd->latestFromCanon();
                         if ($getCanon) {
                         	while ($result=$getCanon->fetch_assoc()) {
                         	
                     ?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
 <a href="details.php?proid=<?php echo $result['productId'];?>"><img src="admin/<?php echo trim($result['image']); ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Laptop</h2>
						  <p><?php echo $result['productName']; ?></p>
	 <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'];?>">Add to cart</a></span></div>
					</div>
				</div>

             <?php }}?>

			</div>


			
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<li><img src="images/fc83715549.jpg" alt=""/></li>
						<li><img src="images/Piccc.jpg" alt=""/></li>
						<li><img src="images/images3333.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>	
















