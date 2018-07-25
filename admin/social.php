<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Brand.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media</h2>


            <?php


$brand=new Brand();
if ($_SERVER['REQUEST_METHOD']=='POST') {
$facebook=$_POST['facebook'];
$twitter=$_POST['twitter'];
$contact=$_POST['contact'];
$googleplus=$_POST['googleplus'];

$updateSocial=$brand->socialUpdate($facebook,$twitter,$contact,$googleplus);
}

             ?>
<?php

if (isset($updateSocial)) {
    echo $updateSocial;
}

 ?>







        <div class="block">   
         <form method="post" action="">
        <?php 
          $query="select*from table_social where id='1'";
               $socialmedia=$db->select($query);
         if ($socialmedia) {
             while ($result=$socialmedia->fetch_assoc()) {
               
          ?>
            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
            <input type="text" name="facebook" placeholder="Facebook link.." class="medium" value="<?php echo $result["facebook"];?>" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="twitter" placeholder="Twitter link.." class="medium" value="<?php echo $result["twitter"];?>"/>
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="contact" placeholder="LinkedIn link.." class="medium" value="<?php echo $result["contact"];?>"/>
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="googleplus" placeholder="Google Plus link.." class="medium" value="<?php echo $result["googleplus"];?>"/>
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            <?php }}?>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>