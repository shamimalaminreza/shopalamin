<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
      <?php
               
           if (isset($_POST['submit'])) {
               
               $oldpassword = mysqli_real_escape_string($db->link,$_POST['oldpassword']);
                $newpassword = mysqli_real_escape_string($db->link,$_POST['newpassword']);
            $sql = "select * from table_admin where  adminPass='".md5($oldpassword )."'";
          $password=$db->select($sql);
          if ($oldpassword =="" || $newpassword=="") {
         echo  "<strong>Field!</strong>Must not be empty";
             }
          elseif ($password) {
          $sql = "update table_admin set adminPass = '".md5($newpassword)."'";
          $password1=$db->update($sql);

            echo  "<strong>Success!</strong> Password Change Successfully";

          }else{
             echo  "<strong>Error!</strong> Wrong old password";

          }

          }
           

      ?>
        <div class="block">
          
      <form action="" method="post" id="signupForm1" class="form-horizontal">
            <table class="form">   


                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
            <input type="password"  id="oldpassword" name="oldpassword"  class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" name="newpassword" id="newpassword" class="medium" />
                    </td>
                </tr>
                 

                <tr>
                    <td>
                        <label>Confirm Password</label>
                    </td>
                    <td>
                        <input type="password" name="confirmpassword" class="medium" />
                    </td>
                </tr>

                 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>


            </table>
            </form>

        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>