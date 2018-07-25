

<?php 
// shob file gulo load kore niye ashaer jonno use kora hy
 $filepath=realpath(dirname(__FILE__));
 

?>
<?php 

class Brand{
	 private $db;
  private $fm;
	
	function __construct(){
	     $this->db=new Database();
         $this->fm=new Format();
	}


public function brandInsert($brandName){

$brandName=$this->fm->validation($brandName);
$brandName=mysqli_real_escape_string($this->db->link,$brandName);

if (empty($brandName)) {
	
$msg="<span style='color:red'>Brand Field must not be empty</span>";

return $msg;
}
else{
$query="INSERT INTO table_brand(brandName) VALUES('$brandName')";
$brandinsert=$this->db->insert($query);
if ($brandinsert) {
	$msg="<span  class='success'>Brand Inserted Successfully</span>";
	return $msg;
}
else
{

$msg="<span  class='error'>Brand not Inserted  </span>";
return $msg;
}

}

  }



public function getAllBrand(){
$query="SELECT * FROM table_brand ORDER BY brandId DESC";
$result=$this->db->select($query);
return $result;

    }

public function getBrandById($id){

$query="SELECT * FROM table_brand WHERE brandId='$id'";
$result=$this->db->select($query);
return $result;


}
//for  brand update
public function brandUpdate($brandName,$id){
$brandName=$this->fm->validation($brandName);
$brandName=mysqli_real_escape_string($this->db->link,$brandName);
$id=mysqli_real_escape_string($this->db->link,$id);

if (empty($brandName)) {
	
$msg="Brand Field must not be empty";

return $msg;
          }else{


$query="UPDATE table_brand
             SET 
             brandName='$brandName'
             WHERE brandId='$id'";
              $updated_row=$this->db->update($query);
					if ( $updated_row) {
					$msg="<span style='color:green';>Brand Updated Successfully</span>";
          return $msg;
					}else{

          $msg="Brand  not Updated ";
           return $msg;
                }
          }


         }




public function delBrandById($id){
$query="DELETE FROM table_brand WHERE brandId='$id'";
//accessing database property for deleting data
$deldata=$this->db->delete($query);
if ($deldata) {
$msg="<span style='color:green;'>Brand deleted Successfully</span>";
return $msg;
}
else
{

$msg="Brand not deleted ";

return $msg;


     }
}








public function socialUpdate($facebook,$twitter,$contact,$googleplus){
$facebook=mysqli_real_escape_string($this->db->link,$facebook);
$twitter=mysqli_real_escape_string($this->db->link,$twitter);
$contact=mysqli_real_escape_string($this->db->link,$contact);
$googleplus=mysqli_real_escape_string($this->db->link,$googleplus);
if (empty($facebook) || empty($twitter) || empty($contact) || empty($googleplus)) {
$msg="Brand Field must not be empty";
return $msg;
          }else{
$query="UPDATE  table_social
             SET 
             facebook='$facebook',
             twitter='$twitter',
            contact='$contact',
            googleplus='$googleplus'";
              $updated_row=$this->db->update($query);
          if ( $updated_row) {
          $msg="<span style='color:green';>Data Updated Successfully</span>";
          return $msg;
          }else{

          $msg="Data  not Updated ";
           return $msg;
                }
          }


}

}
     






?>
