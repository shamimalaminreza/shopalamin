<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
$adminid=Session::get('adminId');
$username=Session::get('username');
//userrole=Session::get('userRole');
?>


        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Update Post</h2>

                <?php

                        if ($_SERVER['REQUEST_METHOD']=='POST') {
                            $adminName=mysqli_real_escape_string($db->link,$_POST['adminName']);
                            $adminUser=mysqli_real_escape_string($db->link,$_POST['adminUser']);
                            $adminEmail=mysqli_real_escape_string($db->link,$_POST['adminEmail']);
                            $adminDetails=mysqli_real_escape_string($db->link,$_POST['adminDetails']);
                          
                   if ( $adminName=="" || $adminUser=="" ||   $adminEmail=="" ||  $adminDetails=="" ) {

                   echo "Field  must not be empty";

                          } else{

           $query="UPDATE   table_admin SET 

               adminName='$adminName',
               adminUser='$adminUser',
               adminEmail='$adminEmail',
               adminDetails='$adminDetails'
              WHERE adminId='$adminid'";          
                $updted_rows = $db->update($query);
                if ($updted_rows ) {

                 echo "<span class='success'>Data updated Sccessfully.</span>";
                }
                else
                 {
                 echo "<span class='error'>Data not updated !</span>";

                      }
                     }

                    }
                  
                   
                   ?>

                <div class="block"> 
<!-- selecting query-->
                    <?php 

             $query="select*from    table_admin where adminId='$adminid'";
            $getuser=$db->select($query);
                    if ($getuser) {
                 while ($getresult=$getuser->fetch_assoc()) {
                     
                    ?>

                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                <input type="text" name="adminName" value="<?php echo $getresult['adminName'];?>" class="medium" />
                            </td>
                        </tr>
                     
                    
                        <tr>
                            <td>
                                <label>UserName</label>
                            </td>
                            <td>
                 <input type="text" name="adminUser" value="<?php echo $getresult['adminUser'];?>" class="medium" />

                            </td>
                        </tr>
                        <tr>  
                         <td>
                                <label>Email</label>
                            </td>         
                 <td> <input type="text" name="adminEmail" value="<?php echo $getresult['adminEmail'];?>" class="medium" /></td>

                        </tr>


                         <tr>
                            <td>
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="adminDetails">
                                    <?php echo $getresult['adminDetails'];?>

                                </textarea>
                            </td>
                        </tr>


                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                  <?php  }} ?>


                </div>
            </div>
        </div>
<!--load tiny mce-->

<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>
<!--load tiny mce-->


<?php include 'inc/footer.php';?>




