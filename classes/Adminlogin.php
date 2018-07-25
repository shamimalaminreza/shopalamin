<?php 
$filepath=realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Session.php');
 
 Session::checkLogin();
// shob file gulo load kore niye ashaer jonno use kora hy
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');
?>


<?php 
class Adminlogin{
          private $db;
          private $fm;
	
	function __construct(){
	     $this->db=new Database();
         $this->fm=new Format();


	}
public function adminLogin($adminUser,$adminPass){

	
$adminUser=$this->fm->validation($adminUser);
$adminPass=$this->fm->validation($adminPass);
//validation of user and password
$adminUser=mysqli_real_escape_string($this->db->link,$adminUser);
$adminPass=mysqli_real_escape_string($this->db->link,$adminPass);

if (empty($adminUser) || empty($adminPass)) {
	
$loginmsg="User name or Password Must not be empty";

return $loginmsg;
}
else
{
//selecting query

$query="select*from  table_admin where adminUser='$adminUser' and adminPass='$adminPass'";	

//accessing selecting query
$result=$this->db->select($query);
if ($result!=false) {
$value=$result->fetch_assoc();
Session::set("adminlogin",true);
Session::set("adminId",$value['adminId']);
Session::set("adminUser",$value['adminUser']);
Session::set("adminName",$value['adminName']);
Session::set("userRole",$value['role']);

header("Location:dashbord.php");
}else {

$loginmsg="User name or Password Not Match";
return $loginmsg;

}

}


}


    }





?>