<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>





                     <?php

                        if ($_SERVER['REQUEST_METHOD']=='POST') {

                             $title=$fm->validation($_POST['title']);
                              $slgan=$fm->validation($_POST['slgan']);
                             $title=mysqli_real_escape_string($db->link,$title);
                             $slgan=mysqli_real_escape_string($db->link,$slgan);  

                            if ($title=="" ||   $slgan=="" ) {
                              echo "Field  must not be empty";
                              }else{

                           $query="UPDATE  tabl_slgan SET 

                            title='$title',
                            slgan=' $slgan'
                            WHERE id='1'";          
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


<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock"> 

                <?php 
                  $query="select*from tabl_slgan where id='1'";
                       $blog_title=$db->select($query);
                 if ($blog_title) {
                     while ($result=$blog_title->fetch_assoc()) {
                       
                  ?>

         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="text"  value="<?php echo $result['title'];?>"  name="title" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['slgan'];?>" name="slgan" class="medium" />
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
               <?php }}?>




        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>