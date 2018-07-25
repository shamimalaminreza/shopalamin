<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock"> 
                       <?php

                        if ($_SERVER['REQUEST_METHOD']=='POST') {

                         $title=$fm->validation($_POST['title']);
                            //this method are used for error detecting 
                             $title=mysqli_real_escape_string($db->link, $title);
                          
                                if ($title=="") {

                              echo "Field  must not be empty";
                                 }else{
                                $query="UPDATE table_footer SET title='$title'
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

                   
           <?php 
          $query="select*from  table_footer where id='1'";
          $socialmedia=$db->select($query);
         if ($socialmedia) {
             while ($result=$socialmedia->fetch_assoc()) { 

             ?> 
         <form method="post" action="">
            <table class="form">					
                <tr>
                    <td>
    <input type="text" name="title" class="large"  value="<?php echo $result['title'];?>" />
                    </td>
                </tr>
				
				 <tr> 
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