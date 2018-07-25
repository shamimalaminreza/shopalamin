
<?php 
// shob file gulo load kore niye ashaer jonno use kora hy
$filepath=realpath(dirname(__FILE__));

 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');

?>


<?php 
//anthe cclass fooor carrrrt
class Cart{
		  private $db;
          private $fm;
	    function __construct(){
	     $this->db=new Database();
        $this->fm=new Format();
	}


//method for add to cart
public function addToCart($quantity,$id){
$quantity      =$this->fm->validation($quantity);
$productId      =$this->fm->validation($id);

$quantity      =mysqli_real_escape_string($this->db->link,$quantity);
$productId     =mysqli_real_escape_string($this->db->link,$id);

//intilaization session id;
$sId           =session_id();
$squery        ="SELECT*FROM table_product WHERE productId='$productId'";
$result         =$this->db->select($squery)->fetch_assoc();

$productName=$result['productName'];
$price=$result['price'];
$image=$result['image'];

//fr checking product added
$chquery        ="SELECT*FROM table_cart WHERE productId='$productId' AND sId='$sId'";

$getPro         =$this->db->select($chquery);
if ($getPro) {
	$msg="Product is already added";
	return $msg;
	//echo $msg;
}else{
  $query="INSERT INTO table_cart (sId,productId,productName,price,quantity,image) VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
     $insertd_row=$this->db->insert($query);
    if ($insertd_row) {
	 header("Location:cart.php");
      }else{


	header("Location:404.php");

            }
        }

	}

//mthd fooorr get data fm cat tabl
	public function getCartProdct(){
    $sId=session_id();
    $query="SELECT * FROM table_cart WHERE sId='$sId'";
    $result=$this->db->select($query);
     return $result;
	}


	//method for updaate card quantity
public function updateCartQuantity($cartId,$quantity){
$cartId=mysqli_real_escape_string($this->db->link,$cartId);
$quantity=mysqli_real_escape_string($this->db->link,$quantity);
$query="UPDATE table_cart SET  quantity='$quantity' WHERE cartId='$cartId'";

              $updated_row=$this->db->update($query);
					if ( $updated_row) {

                   header("Location:cart.php");
					//$msg="<span style='color:green';>Quantity Updated Successfully</span>";
                    //return $msg;
					}else{

              $msg="Quantity not Updated ";

                    return $msg;
                } 
           }


           //mthd fr dlt cartr

 public function delProductByCart($delId){
  $delId=mysqli_real_escape_string($this->db->link,$delId);
  $query="DELETE FROM table_cart WHERE cartId='$delId'";
    $deldata=$this->db->delete($query);
     if ($deldata) {

     //$msg="<span style='color:green'>Cart deleted Successfully</span>";
      //return $msg;
         header("Location:cart.php");

       } else{
   $msg="Cart not deleted ";
    return $msg;

       }
    }


//method for check cart table data
    public function checkCartTable(){
     $sId=session_id();
    $query="SELECT * FROM table_cart WHERE sId='$sId'";
    $result=$this->db->select($query);
   return $result;



    }
//method for del customer cart data from data base when customer logout from product  page 
    public function delCartdata(){
     $sId=session_id();
    $query="DELETE FROM table_cart WHERE sId='$sId'";
    $this->db->delete($query);



    }



//method for order product
     public function orderProduct($cmrId){
//reactive data from table cart for insert into table order
     $sId=session_id();
    $query="SELECT * FROM table_cart WHERE sId='$sId'";
    $getPro=$this->db->select($query);
  if ($getPro) {
   while ($result=$getPro->fetch_assoc()) {
     $productId=$result['productId'];
    $productName=$result['productName'];
     $quantity=$result['quantity'];
     $price=$result['price']*$quantity;
     $image=$result['image'];

     $query="INSERT INTO table_order (cmrId,productId,productName,quantity,price,image) VALUES('$cmrId','$productId','$productName','$quantity','$price','$image')";
     $insertd_row=$this->db->insert($query);

        }
     }

      }

//method for payable amount
      public function payableAmount($cmrId){
        //now() are used for select database date
       $query="SELECT price FROM  table_order WHERE cmrId='$cmrId' AND date=now()";
      $result=$this->db->select($query);
      return $result;


      }

//method for customer data from  order  table 
public function getOrderProduct($cmrId){
$query="SELECT * FROM  table_order WHERE cmrId='$cmrId' ORDER BY date ASC";
      $result=$this->db->select($query);
      return $result;

}

//method for showing order list data
public function checkOrder($cmrId){
 $query="SELECT * FROM  table_order WHERE cmrId='$cmrId'";
    $result=$this->db->select($query);
   return $result;

   }




//method for get all product from order table
    public function getAllOrderProduct(){
    $query="SELECT * FROM  table_order ORDER BY date ASC";
    $result=$this->db->select($query);
   return $result;


        }



public function productShifted($id,$price,$date){
$id=mysqli_real_escape_string($this->db->link,$id);
$price=mysqli_real_escape_string($this->db->link,$price);
$date=mysqli_real_escape_string($this->db->link,$date);
$query="UPDATE table_order SET status='1' WHERE cmrId='$id'  AND price='$price' AND date='$date'";
$updated_row=$this->db->update($query);
          if ($updated_row) {
          $msg="<span style='color:green';> Updated Successfully</span>";
          return $msg;
          }else{
      $msg="not Updated ";
      return $msg;
    }

}



 public function delProductShifted($id,$time,$price){
//for validation
$id=mysqli_real_escape_string($this->db->link,$id);
$date=mysqli_real_escape_string($this->db->link,$time);
$price=mysqli_real_escape_string($this->db->link,$price);
$query="DELETE FROM table_order WHERE cmrId='$id' AND date='$date'AND price='$price'";

//accessing database property for deleting data
$deldata=$this->db->delete($query);

if ($deldata) {

$msg="Data deleted Successfully";
return $msg;
}
else
{

$msg="Data not deleted ";

return $msg;


     }

  }

//method for delproduct
  public function deldelcustid($id){
$id=mysqli_real_escape_string($this->db->link,$id);
$query="DELETE FROM table_order WHERE cmrId='$id'";

//accessing database property for deleting data
$deldata=$this->db->delete($query);

if ($deldata) {

$msg="Data deleted Successfully";
return $msg;
}
else
{

$msg="Data not deleted ";

return $msg;


     }





  }                                                                                                



//mthd for product confirm
  public function productShiftConfirm($id,$price,$time){

$id=mysqli_real_escape_string($this->db->link,$id);
$price=mysqli_real_escape_string($this->db->link,$price);
$date=mysqli_real_escape_string($this->db->link,$time);
$query="UPDATE table_order SET status='3' WHERE cmrId='$id'  AND price='$price' AND date='$date'";
$updated_row=$this->db->update($query);
          if ($updated_row) {
          $msg="<span style='color:green';> Updated Successfully</span>";
          return $msg;
          }else{
      $msg="not Updated ";
      return $msg;
    }


  }


}

?>
