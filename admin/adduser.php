
            <?php include 'inc/header.php';?>
            <?php include 'inc/sidebar.php';?>



              <?php 

              //fif user not admn 
              //if(!Session::get('userRole')=='0'){

              ////echo "<script>window.locaton='index.php';</script";
              //}

              ?>





        <div class="grid_10">
    

            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock">
<!-- from validation -->

                                    <?php 
                                if ($_SERVER['REQUEST_METHOD']=='POST') {

                                $adminUser   =$fm->validation($_POST['adminUser']);
                                $adminPass   =$fm->validation(md5($_POST['adminPass']));
                                $adminEmail      =$fm->validation($_POST['adminEmail']);
                                $role       =$fm->validation($_POST['role']);


                               $adminUser=mysqli_real_escape_string($db->link, $adminUser);
                               $adminPass=mysqli_real_escape_string($db->link, $adminPass);
                               $adminEmail =mysqli_real_escape_string($db->link,  $adminEmail);
                               $role =mysqli_real_escape_string($db->link,  $role);


            if (empty($adminUser)|| empty($adminPass)||empty($adminEmail)||empty($role)) {

                              echo "<span class='error'>Field Must not be empty</span>";


                              }else{

                      //email address existence checking
                    $query="select*from   table_admin where adminEmail='$adminEmail' limit 1";
                      $result=$db->select($query);
                      if ($result!=false) {
                       echo "Email address is already exist";
                      }else{

    $insert="INSERT INTO   table_admin(adminUser,adminPass,adminEmail,role) VALUES('$adminUser','$adminPass','$adminEmail','$role')";
             $catinsert=$db->insert($insert);
                         if ($catinsert) {
                            echo "<span class='success'>User Created Successfully</span>";
                         }else{

                         echo "User Not Created ";

                       }
                        }

                      }
                         
                        }
                     ?>

                     <!-- a new from for adding new user-->
                 <form action=" " method="post">
                    <table class="form">    




                        <tr>
                    <td>
                         <label>Username</label>
                         </td>

                            <td>
                    <input type="text" name="adminUser" placeholder="Enter UserName..." class="medium" />
                            </td>
                        </tr>
                    


<!--email address protection-->


                      <tr> 
                      <tr>
                      <td>
                         <label>Password</label>
                         </td>

                            <td>
                    <input type="text" name="adminPass" placeholder="Enter Password..." class="medium" />
                            </td>
                        </tr>
                        <tr> 




                <tr>
                    <td>
                         <label>Email</label>
                         </td>

                            <td>
                    <input type="text" name="adminEmail" placeholder="Enter valid email address..." class="medium" />
                            </td>
                        </tr>
                        <tr>


         
                <tr>
                    <td>
                         <label>User Role</label>
                         </td>

                            <td>
                  <select id="select" name="role">
                      <option>Select User Role</option>
                       <option value="0">Admin</option>
                       <option value="1">Author</option>
                       <option value="2">Editor</option>

                  </select>
                            </td>
                        </tr>
                        <tr> 
                             <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create"/>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'inc/footer.php';?>