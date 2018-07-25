<?php 
include '../lib/Session.php';
Session::checkLogin();
//Session::init();
?>

<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>

<?php 

$db=new Database();
$fm=new Format();


?>

<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">


	<!-- making password protection-->
        		<?php 
        		if ($_SERVER['REQUEST_METHOD']=='POST') {
        		$adminEmail=$fm->validation($_POST['adminEmail']);
        		$adminEmail=mysqli_real_escape_string($db->link,$adminEmail);
            if (!filter_var($adminEmail,FILTER_VALIDATE_EMAIL)) {
            echo "<b>invalid email Address</b>";
           }else{

           $query="select*from  table_admin where adminEmail='$adminEmail' limit 1";
            $result=$db->select($query);
             if ($result!=false) {
                while ( $value=$result->fetch_assoc()) {

               $adminId=$value['adminId'];
               $adminUser=$value['adminUser'];

                }
              $text=substr($adminEmail, 0,3);
              $rand=rand(10000,99999);
              $newpass="$text$rand";
              $adminPass=md5($newpass);


               $query="UPDATE table_admin SET adminPass='$adminPass' WHERE adminId='$adminId'";
               $updated_row=$db->update($query);

               $to       ="$adminEmail";
               $from     ="sreza965@gmail.com";
               $headers  ="From:$from\n";
               $headers .= 'MIME-Version: 1.0'."\r\n";
               $headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
               $subject  ="Your password";
               $message  ="Your username is ".$adminUser." and password is ".$newpass."please viste website to login";
               $sendmail=mail($to, $subject, $message,$headers);
               if ($sendmail) {
               	echo "please check your email for new password";
               }else{

           	   echo "<span style='color:red;font-size:18px;'>Mail not sent</span>";

               }

              }else {
			  echo "<span style='color:red;font-size:18px;'>Mail not exist</span>";
			    }
			}

			  }

      		?>



      <form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Your Email" required="" name="adminEmail"/>
			</div>
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form>


		<!-- form -->
             <div class="button">
             <!-- for password recover-->
			<a href="login.php">Login</a>
		</div>
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>












