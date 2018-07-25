<?php include 'inc/header.php';?>

<?php include 'inc/sidebar.php';?>

  
<!--showing userlist-->

        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>

                  <?php 
//for deleting user
                  if (isset($_GET['deluser'])) {
                   $delid=$_GET['deluser'];
                  $query="delete from  table_admin where adminId='$delid'";
                  $result=$db->delete($query);
                  if ($result) {
                    echo "<span style='color:green;width:0px; background:#ddd;'>User deleted successfully</span>";
                  }
                  else
                  {

                  echo "User not deleted successfully";
                   }
                  }

                  ?>




                <div class="block">        
                <table class="data display datatable" id="example" style="width: 100%">
					      <thead>
						    <tr>
							<th width="">Serial No.</th>
							<th width="">Name</th>
                <th width="">Username</th>
                   <th width="">password</th>
                    <th width="">Email</th>
                      <th width="">Details</th>
                      <th width="">Role</th>
							         <th width="">Action</th>
        						</tr>
        					</thead>
        					<tbody>

					<!--showing category in admin panel from database table-->
                    <?php 
                    
                    $query="select*from    table_admin order by adminId desc";
                      $alluser=$db->select($query);

                      if ($alluser) {
                      	$adminId=0;
                         while ($result=$alluser->fetch_assoc()) {
         	           $adminId++;

                  ?>

		<tr class="odd gradeX">
			<td><?php echo $adminId;?></td>
			<td><?php echo $result['adminName'];?></td>
  <td><?php echo $result['adminUser'];?></td>
    <td><?php echo $result['adminPass'];?></td>

    <td><?php echo $result['adminEmail'];?></td>
      <td><?php echo $fm->textShorten($result['adminDetails'],30);?></td>
        <td>

        <?php 
        if ($result['role']=='0') {
         echo "Admin";
        }elseif ($result['role']=='1') {
          echo "Author";
        }elseif ($result['role']=='2'){
         echo "Editor";

        }
        ?>
          

        </td>

<td><a  onclick="return confirm('are you sure want to view?');" href="viewuserid.php?vuserid=<?php  echo $result['adminId'];?>">
View</a> 

<!--only user can delete-->
<?php if(Session::get('userRole')=='0') {?>

 <a onclick="return confirm('are you sure want to delete?');" href="?deluser=<?php echo $result['adminId'];?>">Delete</a>

<?php }?>
 </td>
		</tr>
		


        <?php } }?>

					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();

            $('.datatable').dataTable();
            setSidebarHeight();


        });
    </script>
<?php include 'inc/footer.php';?>
