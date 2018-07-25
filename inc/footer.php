

</div>
   <div class="footer" style="background: #000;">
   	  <div class="wrapper">	
	     <div class="section group">
				<div class="col_1_of_4 span_1_of_4">
						<h4>Information</h4>
						<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Customer Service</a></li>
						<li><a href="#"><span>Advanced Search</span></a></li>
						<li><a href="#">Orders and Returns</a></li>
						<li><a href="contact.php"><span>Contact Us</span></a></li>
						</ul>
					</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Why buy from us</h4>
						<ul>
						<li><a href="#">About Us</a></li>
						<li><a href="#">Customer Service</a></li>
						<li><a href="#">Privacy Policy</a></li>
						<li><a href="#"><span>Site Map</span></a></li>
						<li><a href="#"><span>Search Terms</span></a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>My account</h4>
						<ul>
							<li><a href="#">Sign In</a></li>
							<li><a href="#">View Cart</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Track My Order</a></li>
							<li><a href="">Help</a></li>
						</ul>
				</div>
				<div class="col_1_of_4 span_1_of_4">
					<h4>Contact</h4>
						<ul>
							<li><span>+88-01937391800</span></li>
							<li><span>+88-018114867138</span></li>
							
						</ul>

               

					
						<div class="social-icons">
							<h4>Follow Us</h4>
        <?php 
          $query="select*from table_social where id='1'";
               $socialmedia=$db->select($query);
         if ($socialmedia) {
             while ($result=$socialmedia->fetch_assoc()) {
               
          ?>
			  <ul>

         
<li class="facebook"><a href="<?php echo $result['facebook']; ?>" target="_blank" name="facebook"> </a></li>
<li class="twitter"><a href="<?php echo $result['twitter']; ?>" target="_blank" name="twitter"> </a></li>
<li class="googleplus"><a href="<?php echo $result['googleplus']; ?>" target="_blank" name="googleplus"> </a></li>
	<li class="contact"><a href="<?php echo $result['contact']; ?>" target="_blank" name="contact"> </a></li>


						<div class="clear"></div>
                       
						     </ul>
                          <?php }}?>

   	 					</div>
				</div>
			</div>
			<div class="copy_right">

                            
           <?php 
          $query="select*from  table_footer where id='1'";
          $socialmedia=$db->select($query);
         if ($socialmedia) {
             while ($result=$socialmedia->fetch_assoc()) {  
          ?>
		<p><?php echo $result['title'];?></p>
           <?php }}?>
          


		   </div>
     </div>
    </div>
    <script type="text/javascript">
		$(document).ready(function() {
			/*
			var defaults = {
	  			containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
	 		};
			*/
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
    <a href="#" id="toTop" style="display: block;"><span id="toTopHover" style="opacity: 1;"></span></a>
    <link href="css/flexslider.css" rel='stylesheet' type='text/css' />
	  <script defer src="js/jquery.flexslider.js"></script>
	  <script type="text/javascript">
		$(function(){
		  SyntaxHighlighter.all();
		});
		$(window).load(function(){
		  $('.flexslider').flexslider({
			animation: "slide",
			start: function(slider){
			  $('body').removeClass('loading');
			}
		  });
		});
	  </script>
</body>
</html>
