
<?php 
// shob file gulo load kore niye ashaer jonno use kora hy
$filepath=realpath(dirname(__FILE__));
 
?>
<?php 

class Category{
	
	         private $db;
          private $fm;
	
	function __construct(){
	     $this->db=new Database();
         $this->fm=new Format();

}
	

public function catInsert($catName){

$catName=$this->fm->validation($catName);
$catName=mysqli_real_escape_string($this->db->link,$catName);
if (empty($catName)) {
	
$msg="<p style='color:red;'>Category Field must not be empty</p>";

return $msg;
}
else{
$query="INSERT INTO  table_cat(catName) VALUES('$catName')";
$catinsert=$this->db->insert($query);
if ($catinsert) {
	$msg="<span  class='success'>Category Inserted Successfully</span>";
	return $msg;
}
else
{

$msg="<span  class='error'>Category not Inserted  </span>";
return $msg;
}

}

  }

//method of addimg cat

  public function getAllCat(){
//selecting category from database table
$query="SELECT * FROM table_cat ORDER BY catId DESC";
$result=$this->db->select($query);
return $result;

  }


//method of selecting  category
  public function getCatById($id){

$query="SELECT * FROM table_cat WHERE catId='$id'";
$result=$this->db->select($query);
return $result;

  }


public function catUpdate($catName,$id){


$catName=$this->fm->validation($catName);
$catName=mysqli_real_escape_string($this->db->link,$catName);
$id=mysqli_real_escape_string($this->db->link,$id);

if (empty($catName)) {
	
$msg="Category Field must not be empty";

return $msg;
          }else{


$query="UPDATE table_cat
             SET 
             catName='$catName'
             WHERE catId='$id'";
              $updated_row=$this->db->update($query);
					if ( $updated_row) {
					$msg="<span style='color:green';>Category Updated Successfully</span>";

                    return $msg;
					}

                else
                {

$msg="Category not Updated ";

                    return $msg;


                }
          }


         }


//for deleting category
    public function delCatById($id){
    $query="DELETE FROM table_cat WHERE catId='$id'";
//accessing database property for deleting data
    $deldata=$this->db->delete($query);
    if ($deldata) {
   $msg="<span class='success'>Category deleted Successfully</span>";
   return $msg;
   }
  else
{

$msg="Category not deleted ";

return $msg;


     }

    }


}


?>