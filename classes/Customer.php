

<?php 
// shob file gulo load kore niye ashaer jonno use kora hy
$filepath=realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');
?>




<?php 

class Customer{
	
		  private $db;
      private $fm;
	    function __construct(){
	   $this->db=new Database();
      $this->fm=new Format();
		
	}

//mthd for customr gistration
public function customerRegistration($data){
	//for validation of registration field
$name=mysqli_real_escape_string($this->db->link,$data['name']);
$address=mysqli_real_escape_string($this->db->link,$data['address']);
$city=mysqli_real_escape_string($this->db->link,$data['city']);
$country=mysqli_real_escape_string($this->db->link,$data['country']);
$zip=mysqli_real_escape_string($this->db->link,$data['zip']);
$phone=mysqli_real_escape_string($this->db->link,$data['phone']);
$email=mysqli_real_escape_string($this->db->link,$data['email']);
$password=mysqli_real_escape_string($this->db->link,md5($data['password']));

if ($name==""||$address==""||$city==""||$country==""||$zip==""||  $phone==""||$email==""||$password=="") {
		
$msg=" <p style='color:red'>Field must not be empty</p>";

return $msg;

}

//for email validation
$query="SELECT*FROM table_customer WHERE email='$email' LIMIT 1";
$mailcheck=$this->db->select($query);
if ($mailcheck!=false) {
	$msg="<span style='color:red;'>Email is already exist</span>";
	return $msg;

}else{
$query="INSERT INTO table_customer(name,address,city,country,zip,phone,email,password) VALUES('$name','$address','$city','$country','$zip',' $phone','$email','$password')";
$productinsert=$this->db->insert($query);
if ($productinsert) {
	$msg="<span style='color:green'>Customer Data Inserted Successfully</span>";
	return $msg;
}else{
$msg="<span  class='error'>Customer  Data Inserted not Successfully</span>";
return $msg;
      }

   }
}





//method for customer login
public function customerLogin($data){
$email=mysqli_real_escape_string($this->db->link,$data['email']);
$password=mysqli_real_escape_string($this->db->link,md5($data['password']));
if (empty($email) || empty($password)){
	
$msg=" <span style='color:red'>Field must not be empty</span>";
return $msg;

      }

$query="SELECT*FROM table_customer WHERE email='$email' AND password='$password'";
$result=$this->db->select($query);
if ($result!=false) {
	$value=$result->fetch_assoc();
	//customer table data
    Session::set("cuslogin",true);
    Session::set("cmrId",$value['id']);
    Session::set("cmrName",$value['name']);
    header("Location:cart.php");
}else{

$msg="<span style='color:red;width:400px;background:gr;height:100px;'>Email Or Password not match</span>";
	return $msg;

}
  }

//method for customer table data
public function getCustomerData($id){
$query="SELECT * FROM table_customer WHERE id='$id'";
$result=$this->db->select($query);
return $result;
  }


//mthd for update cstomer proflee
  public function customerUpdate($data,$cmrId){
$name=mysqli_real_escape_string($this->db->link,$data['name']);
$phone=mysqli_real_escape_string($this->db->link,$data['phone']);
$email=mysqli_real_escape_string($this->db->link,$data['email']);
$address=mysqli_real_escape_string($this->db->link,$data['address']);
$city=mysqli_real_escape_string($this->db->link,$data['city']);
$zip=mysqli_real_escape_string($this->db->link,$data['zip']);
$country=mysqli_real_escape_string($this->db->link,$data['country']);


if ($name=="" || $phone=="" || $email=="" || $address=="" || $city=="" || $zip=="" || $country=="") {
	
$msg="<span style='color:red;'> Field must not be empty</span>";
return $msg;

 }else{

$query="UPDATE table_customer
             SET 
             name='$name',
              phone='$phone',
               email='$email',
                address='$address',
                 city='$city',
                  zip='$zip',
                   country='$country'
             WHERE id='$cmrId'";
              $updated_row=$this->db->update($query);
					if ( $updated_row) {
					$msg="<span style='color:green';>Data Updated Successfully</span>";

                    return $msg;
					}else {

           $msg="Category not Updated ";
               return $msg;


                }
          }


         } 

}

?>