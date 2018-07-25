<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

            <?php 

            $db=new Database();
            $fm=new Format();

             ?>

<?php 

if (!isset($_GET['msgid']) || $_GET['msgid']=='NULL') {
   
header("Location:inbox1.php");
echo "<script>window.location='inbox1.php';</script>";

}
else
{

$id=$_GET['msgid'];


}

?>

        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>View Message</h2>

                <?php
                //dynamic page creation

                        if ($_SERVER['REQUEST_METHOD']=='POST') {

                            //transforming into inbox page
                          echo "<script>window.location='inbox1.php';</script>";
                   }
                   ?>


                <div class="block"> 
                 <form action="" method="post">
<!--select query from database table-->
                  <?php 
                    $query="select*from  table_contact where id='$id'";
                      $msg=$db->select($query);

                      if ($msg) {
                    
                         while ($result=$msg->fetch_assoc()) {
                  ?>

                    <table class="form">
                       <!--showing data from database table-->
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                      <input type="text" readonly value="<?php echo $result['name'];?>" class="medium" />
                            </td>
                        </tr>


                           <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text"   readonly value="<?php echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>
                     


                           <tr>
                            <td>
                                <label>Mobile</label>
                            </td>
                            <td>
                                <input type="text"   readonly value="<?php echo $result['mobile'];?>" class="medium" />
                            </td>
                        </tr>
                    
                         <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message">
                                    <?php echo $result['message'];?>

                                </textarea>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>

                   <?php }} ?>

                    </form>
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


