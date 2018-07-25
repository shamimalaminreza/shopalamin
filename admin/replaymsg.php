
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


<?php 

if (!isset($_GET['repid']) || $_GET['repid']=='NULL') {
   
header("Location:inbox1.php");
//echo "<script>window.location='inbox1.php';</script>";
}
else
{

$id=$_GET['repid'];


}

?>






        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Replay Message</h2>

                <?php
                //foor  sending meessage

                if ($_SERVER['REQUEST_METHOD']=='POST') {
                    //for replay meessage
                 $to=$fm->validation($_POST['toEmail']);
                $from=$fm->validation($_POST['fromEmail']);
                 $subject=$fm->validation($_POST['subject']);
                 $message=$fm->validation($_POST['message']);

                 if (empty($to)||empty($from)||empty($subject)||empty($message)) {
                    echo "Field must not be empty";
                 }else{
                 //using mail function for send email
                 $sendemail=mail($to,$subject,$message,$from);
                        if ($sendemail) {
                            echo "<span style='color:green'>Message Sent Successfully</span>";
                        }else{

                       echo "<span style='color:red'>Message Sent not  Successfully</span>";
                          }
                        }
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
                       
                           <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                <input type="text" readonly=""  name="toEmail" value="<?php echo $result['email'];?>" class="medium" />
                            </td>
                        </tr>
                     
                     <tr>


                           <tr>
                            <td>
                                <label>Form</label>
                            </td>
                            <td>
            <input type="text"   name="fromEmail" placeholder="please enter your email address" class="medium" />
                            </td>
                        </tr>
                     
                     <tr>


                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
            <input type="text"   name="subject" placeholder="please enter your subject" class="medium" />
                            </td>
                        </tr>
                     
    
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message"> </textarea>
                            </td>
                        </tr>



                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
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


