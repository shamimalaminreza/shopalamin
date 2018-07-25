<?php include 'inc/header.php'; ?>

		            <?php 
//if login is true it transfering into order page
                        $login=Session::get("cuslogin");
                        if ($login==true) {
                        header("Location:order.php");
                     }

		            ?>
               <?php 
				//mthd fr cstmr login
				if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])) {
				$custLogin=$cmr->customerLogin($_POST);

				}
				?>

             <div class="main">
             <div class="content">
    	     <div class="login_panel" style="height: 285px;">
<!--showing message for log in-->
				<?php 
				if (isset($custLogin)) {
					echo $custLogin;
				}

				?>

		        	<h3>Existing Customers</h3>
		        	<p>Sign in with the form below.</p>
        	      <form action="" method="post">
                	<input name="email" placeholder="Email" type="text">
                    <input name="password"  placeholder="password" type="password">
                     <div class="buttons"><div><button class="grey" name="login">Sign In</button></div></div>
                    </div>

                 </form>
                   
				<?php 
				//mthd fr cstmr registation
				if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])) {
				$customerReg=$cmr->customerRegistration($_POST);

				}
				?>

    	        <div class="register_account">
				<?php 
				if (isset($customerReg)) {
					echo $customerReg;
				}

				?>

    		<h3>Register New Account</h3>



    		      <form action=" " method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name"/>
							</div>
							
							<div>
							  <select name="city"> 
							  <option value="value1">City</option> 
							  <option value="Noakhal">Noakhal</option>

							  <!--<option value="Dhaka">Dhaka</option>
							  <option value="Comilla">Comilla</option>
                              <option value="Chttagong">Chttagong</option> 
							  <option value="Rajshahi">Rajshahi</option>
							  <option value="Sylhet">Sylhet</option>
							  <option value="Tangail">Tangail</option>-->
						    	</select>



							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Zip-Code"">
							</div>
							<div>
								<input type="text" name="email" placeholder="Email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
						<input type="text" name="country" placeholder="Country">
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Phone">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button class="grey" name="register">Create Account</button></div></div>


		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>



    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php include 'inc/footer.php';?>

