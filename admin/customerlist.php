<?php include 'inc/header.php';?>

<?php include 'inc/sidebar.php';?>

  
<!--showing userlist-->

        <div class="grid_10">
            <div class="box round first grid">
                <h2>User List</h2>

                  <?php 
//for deleting user
                  if (isset($_GET['deluser'])) {
                   $id=$_GET['deluser'];
                  $query="delete from  table_customer where id='$id'";
                  $result=$db->delete($query);
                  if ($result) {
                    echo "<span style='color:green;width:0px; backgrounddd;'>Customer deleted successfully</span>";
                  }
                  else{

                  echo "Customer not deleted successfully";
                   }
                  }

                  ?>




                <div class="block">        
                <table class="data display datatable" id="example" style="width: 100%">
					      <thead>
						    <tr>
							<th width="">Serial No.</th>
							<th width="">Name</th>
                <th width="">Address</th>
                   <th width="">City</th>
                    <th width="">Country</th>
                      <th width="">Zip</th>
                      <th width="">Phone</th>
                      <th width="">Email</th>

							         <th width="">Action</th>
        						</tr>
        					</thead>
        					<tbody>

					<!--showing category in admin panel from database table-->
                    <?php 
                    
                    $query="select*from  table_customer order by id desc";
                      $alluser=$db->select($query);

                      if ($alluser) {
                      	$id=0;
                         while ($result=$alluser->fetch_assoc()) {
         	           $id++;

                  ?>

		<tr class="odd gradeX">
			<td><?php echo $id;?></td>
			<td><?php echo $result['name'];?></td>
  <td><?php echo $result['address'];?></td>
    <td><?php echo $result['city'];?></td>

    <td><?php echo $result['country'];?></td>
        <td><?php echo $result['zip'];?></td>
    <td><?php echo $result['phone'];?></td>
    <td><?php echo $result['email'];?></td>

<td><a  onclick="return confirm('are you sure want to view?');" href="viewcustomerid.php?vcustopmerid=<?php  echo $result['id'];?>">
View</a> 

<!--only user can delete-->
<?php if(Session::get('userRole')=='0') {?>

 <a onclick="return confirm('are you sure want to delete?');" href="?deluser=<?php echo $result['id'];?>">Delete</a>

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
