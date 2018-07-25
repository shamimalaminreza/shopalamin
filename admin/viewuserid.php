<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

                <?php 

                if (!isset($_GET['vuserid']) || $_GET['vuserid']=='NULL') {
                   
                //header("Location:catlist.php");
                echo "<script>window.location='userlist.php';</script>";

                }
                else
                {

                $id=$_GET['vuserid'];


                }

                ?>





              <div class="grid_10">
            <div class="box round first grid">
                <h2>User Details</h2>

                <?php
//after the viewing this is gone to the userlist page again
            if ($_SERVER['REQUEST_METHOD']=='POST') {
               echo "<script>window.location='userlist.php';</script>";

                  }
                   ?>


                <div class="block"> 

<!-- selecting query-->

                    <?php 

             $query="select*from  table_admin where adminId='$id'";
            $getuser=$db->select($query);
             if ($getuser) {
                 while ($result=$getuser->fetch_assoc()) {
                     
                    ?>

                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                     <input type="text" name="adminName" value="<?php echo $result['adminName'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        
                        <tr>
                            <td>
                                <label>Userame</label>
                            </td>
                            <td>
                     <input type="text" name="adminUser" value="<?php echo $result['adminUser'];?>" class="medium" />
                            </td>
                        </tr>
                     
                            
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                     <input type="text" name="adminEmail" value="<?php echo $result['adminEmail'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="adminDetails">
                                    
                             <?php echo $result['adminDetails'];?>


                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok"/>
                            </td>
                        </tr>
                    </table>
                    </form>
                     <?php   }} ?>


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




