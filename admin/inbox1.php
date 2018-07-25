<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


<div class="grid_10">
<div class="box round first grid">
				<?php 
              
                   //for transfring  messaG too seen bbx
              if (isset($_GET['seenid'])) {
              	$seenid=$_GET['seenid'];
                   $query="UPDATE   table_contact

                            SET 
                            status= '1'
                            WHERE id='$seenid'";
                            $updated_row=$db->update($query);
                            if ($updated_row) {
                            echo "<span class='success'>Message sent in the seen box</span>";
                            }

                            else
                            {
                            echo "<span>Message not sent in the seen box</span>";
                        }
                     }
				?>
                     <h2>Inbox</h2>
                     <div class="block">        
                      <table class="data display datatable" id="example">
					<thead>
						<tr style="text-align: center;">
							<th style="text-align: center;">Serial No.</th>
							<th style="text-align: center;">Name</th>
							<th style="text-align: center;">Email</th>
							<th style="text-align: center;">Mobile</th>


							<th style="text-align: center;">Message</th>

						
							<th style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>

			              <?php 
			         //method for select cntact data
			              $query="select*from   table_contact where status='0' order by id desc";
			                   $table_contact=$db->select($query);
			             if ($table_contact) {
			             	$i=0;
			                 while ($result=  $table_contact->fetch_assoc()) {
			                   $i++;
			              ?>


						    <tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['name'];?></td>
							<td><?php echo $result['email'];?></td>
							<td><?php echo $result['mobile'];?></td>
							<td><?php echo $fm->textShorten($result['message']);?></td>
							

							

							<td>


<a onclick="return confirm('Are You sure want to viewmsg?');" href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a>|| 
<a onclick="return confirm('Are You sure want to replaymsg?');" href="replaymsg.php?repid=<?php echo $result['id'];?>">Reply</a>|| 
<a onclick="return confirm('Are You sure want to transfring ?');" href="?seenid=<?php echo $result['id'];?>">Seen</a>
							</td>
						</tr>
                        <?php }} ?>

					</tbody>
				</table>
               </div>
            </div>
             <div class="box round first grid">




                <?php 

               //method for category deleted

				if (isset($_GET['delid'])) {
					$delid=$_GET['delid'];
                    $query="delete from   table_contact where id='$delid'";
                     $deldata=$db->delete($query);
                     if ($deldata) {
                     	echo "<P style='color:green'>Message deleted successfully</P>";
                     }else{
                     echo "Message deleted not  successfully";


                     }

				      }
				
				 ?>


                <h2>Seen Message</h2>
                <div class="block">        
                     <table class="data display datatable" id="example">
					<thead>
						<tr style="text-align: center;">
							<th style="text-align: center;">Serial No.</th>
							<th style="text-align: center;">Name</th>
							<th style="text-align: center;">Email</th>
							<th style="text-align: center;">Mobile</th>

							<th style="text-align: center;">Message</th>
							
							<th style="text-align: center;">Action</th>
						</tr>
					</thead>
					<tbody>

			              <?php 
			         //method for select cntact data
			              $query="select*from   table_contact where status='1' order by id desc";
			                   $table_contact=$db->select($query);
			             if ($table_contact) {
			             	$i=0;
			                 while ($result=  $table_contact->fetch_assoc()) {
			                   $i++;
			              ?>


						    <tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['name'];?></td>
							<td><?php echo $result['email'];?></td>							
							<td><?php echo $result['mobile'];?></td>
							<td><?php echo $fm->textShorten($result['message']);?></td>
							
							<td>
<a onclick="return confirm('Are You sure want to viewmsg?');" href="viewmsg.php?msgid=<?php echo $result['id'];?>">View</a>
||<?php if(Session::get('userRole')=='0') {?>
<a onclick="return confirm('Are You sure want to replaymsg?');" href="replaymsg.php?repid=<?php echo $result['id'];?>">Reply</a>||    
<a onclick="return confirm('Are You sure want to delete?');" href="?delid=<?php echo $result['id'];?>">Delete</a> 
<?php }?>
							</td>
						</tr>
                        <?php }} ?>

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



























