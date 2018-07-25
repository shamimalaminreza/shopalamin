<?php include 'inc/header.php';?>
 

<?php 

//if user is not log in he can not access contact page
$login=Session::get('cuslogin');
if ($login==false) {
	header("Location:login.php");
}

?>


         <?php 

			if ($_SERVER['REQUEST_METHOD']=='POST') {
			$name=$fm->validation($_POST['name']);
	       $email=$fm->validation($_POST['email']);
            $mobile=$fm->validation($_POST['mobile']);
            $message=$fm->validation($_POST['message']);
        
			$name=mysqli_real_escape_string($db->link,$name);//username protection
            $email=mysqli_real_escape_string($db->link,$email);
			$mobile=mysqli_real_escape_string($db->link,$mobile);
			 $message=mysqli_real_escape_string($db->link,$message);
//reflexs variable

		     $error="";	
           if (empty($name)) {
           $error="First name must  not be empty";	
           }elseif (empty($email)) {
       $error="Email name must  not be empty";
           }elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
           $error="<p style='width:665px;background:gray;height:30px;'>invalid email Address</p>";
           }elseif (empty($mobile)) {
          $error="Field must not be empty";
          }elseif (empty($message)) {
          $error="Message must not be empty";
//data base a value insert kora
           }else{
    $query = "INSERT INTO  table_contact( name,email,mobile,message) VALUES( '$name',' $email','$mobile','$message')";
                                                
                $inserted_rows = $db->insert($query);
                if ($inserted_rows) {
            $msg="Message send successfully";
                
                }
                else
                 {
               
              $error="Message not send";

           }
           }
          }
         ?>






 <div class="main">
    <div class="content">
    	<div class="support">


    	<!--showing message-->

			
  			<div class="support_desc">

  				<h3>Live Support</h3>
  				<p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp; Live Technical Support</span></p>
  				<p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p>
  			</div>
  				<img src="web/images/contact.png" alt="" />
  			<div class="clear"></div>
  		</div>
    	<div class="section group">
				<div class="col span_2_of_3">
				  <div class="contact-form">
				  	<h2>Contact Us</h2>

        <?php 
			if (isset($error)) {
			echo "<span style='color:red'>$error</span>";
			}

			if (isset($msg)) {
			echo "<span style='color:green'>$msg</span>";
			}

			?>

					    <form action="" method="post">
					    	<div>
						    	<span><label>NAME</label></span>
						    	<span><input type="text" value="" name="name"></span>
						    </div>
						    <div>
						    	<span><label>E-MAIL</label></span>
						    	<span><input type="text" value="" name="email"></span>
						    </div>
						    <div>
						     	<span><label>MOBILE.NO</label></span>
						    	<span><input type="text" value="" name="mobile"></span>
						    </div>
						    <div>
						    	<span><label>SUBJECT</label></span>
						    	<span><textarea name="message"> </textarea></span>
						    </div>
						   <div>
						   		<span><input type="submit" value="SUBMIT"></span>
						  </div>
					    </form>
				  </div>
  				</div>


<!-- for pick up value from database table-->
                  <?php 
                   $query="SELECT*FROM  table_info ORDER BY id";
                   $text=$db->select($query);
                   if ($text) {
                   	   $i=0;
                       while ($result=$text->fetch_assoc()) {
                       	$i++;
                  ?>
                
				<div class="col span_1_of_3">
      			<div class="company_address">
				     	<h2>Company Information :</h2>
				    	<p><?php echo $result['title']?></p>
				   		<p><?php echo $result['address']?></p>
				   		<p><?php echo $result['country']?></p>
				   		<p>Phone:<?php echo $result['phone']?></p>
				   		<p>Fax:<?php echo $result['fax']?></p>
				 	 	<p>Email:<?php echo $result['email']?></p>
<a href="http://www.facebook.com"><p>Follow on: <span><p><?php echo $result['follow on']?></p></span></p></a>
				   </div>
				 </div>


            <?php   }}?>

			
			  </div>    	
    </div>
 </div>

<?php include 'inc/footer.php';?>
