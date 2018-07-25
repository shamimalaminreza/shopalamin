

<?php 
// shob file gulo load kore niye ashaer jonno use kora hy

 $filepath=realpath(dirname(__FILE__));
 include_once ($filepath.'/../lib/Database.php');
 include_once ($filepath.'/../helpers/Format.php');
 
?>
<?php 
class Product{
	      private $db;
        private $fm;
	     function __construct(){
	     $this->db=new Database();
       $this->fm=new Format();
}
//for a method
//file are used for working with a image
public function productInsert($data,$file){
$productName=mysqli_real_escape_string($this->db->link,$data['productName']);
$catId=mysqli_real_escape_string($this->db->link,$data['catId']);
$brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);
$body=mysqli_real_escape_string($this->db->link,$data['body']);
$price=mysqli_real_escape_string($this->db->link,$data['price']);
$oldprice=mysqli_real_escape_string($this->db->link,$data['oldprice']);
$type=mysqli_real_escape_string($this->db->link,$data['type']);

//for working with image file
$permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));

    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
 
    $uploaded_image = "uploads/".$unique_image;

   
if ($productName==""||$catId==""||$brandId==""||$body==""||$price==""|| $oldprice==""|| $file_name==""||$type=="") {
		
$msg="<p style='color:red;'>Field must not be empty</p>";

return $msg;

}elseif ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
    }
else
{

move_uploaded_file($file_temp, $uploaded_image);
$query="INSERT INTO  table_product(productName,catId,brandId,body,price,oldprice,image,type) VALUES('$productName','$catId','$brandId','$body','$price','$oldprice','$uploaded_image','$type')";

$productinsert=$this->db->insert($query);
if ($productinsert) {
	$msg="<span  class='success'>Product Inserted Successfully</span>";
	return $msg;
}
else
{

$msg="<span  class='error'>Product  Inserted not Successfully</span>";
	return $msg;

      }

    }

 }

//for showing a product list

public function getAllProduct(){
//for inner join in three table

/*$query="SELECT p.*,c.catName,b.brandName
FROM  table_product as p, table_cat as c, table_brand as b
WHERE p.catId=c.catId AND p.brandId=b.brandId
ORDER BY p.productId DESC";*/

  $query="SELECT table_product.*,table_cat.catName,table_brand.brandName
     FROM table_product
     INNER JOIN table_cat
     ON table_product.catId=table_cat.catId

    INNER JOIN table_brand
     ON table_product.brandId=table_brand.brandId

   ORDER BY table_product.productId DESC";
  $result=$this->db->select($query);

    return $result;

    }



//for select product

public function getProById($id){
$query="SELECT * FROM table_product WHERE productId='$id'";
$result=$this->db->select($query);
return $result;


     }

//for update product

public function productUpdate($data,$file,$id){

$productName=mysqli_real_escape_string($this->db->link,$data['productName']);
$catId=mysqli_real_escape_string($this->db->link,$data['catId']);
$brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);
$body=mysqli_real_escape_string($this->db->link,$data['body']);
$price=mysqli_real_escape_string($this->db->link,$data['price']);
$type=mysqli_real_escape_string($this->db->link,$data['type']);

//for working with image file
    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $file['image']['name'];
    $file_size = $file['image']['size'];
    $file_temp = $file['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;
if ($productName==""||$catId==""||$brandId==""||$body==""||$price==""|| $type=="") {
		
$msg=" Field must not be empty";

return $msg;

}else{
if (!empty($file_name )) {
	

if ($file_size >1048567) {
     echo "<span class='error'>Image Size should be less then 1MB!
     </span>";
    } elseif (in_array($file_ext, $permited) === false) {
     echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
    }
else
{
//when image ar stay
move_uploaded_file($file_temp, $uploaded_image);
$query="UPDATE table_product
SET              
productName='$productName',
catId='$catId',
brandId='$brandId',
body='$body',
price='$price',
image='$uploaded_image',
type='$type'
WHERE 
productId='$id';
 ";



$productupdate=$this->db->update($query);
if ($productupdate) {
	$msg="<span  class='success'>Product Updated Successfully</span>";
	return $msg;
}
else
{

$msg="<span  class='error'>Product  Updated not Successfully</span>";
	return $msg;

      }

    }

}else{

//when image are not find
$query="UPDATE table_product SET productName='$productName',catId='$catId',brandId='$brandId',body='$body',price='$price',
type='$type'
WHERE 
productId='$id';
 ";



$productupdate=$this->db->update($query);
if ($productupdate) {
	$msg="<span  class='success'>Product Updated Successfully</span>";
	return $msg;
}
else
{

$msg="<span  class='error'>Product  Updated not Successfully</span>";
	return $msg;

      }

    }


}

 }


//for deleting product
public function delProById($id){
$query="SELECT*FROM table_product WHERE productId='$id'";
$getData=$this->db->select($query);
if ($getData) {
	while ($delImg=$getData->fetch_assoc()){
		$dellink=$delImg['image'];
        //code for file xsting
        if (file_exists($dellink)) {
          unlink($dellink);

        }
	}
}
//for deleting all value from database table
$query="DELETE FROM table_product WHERE productId='$id'";

$deldata=$this->db->delete($query);

if ($deldata) {

$msg="<p style='color:green;'>Product deleted Successfully</p>";
return $msg;
}else{
$msg="Product not deleted ";
return $msg;
     }

      }


      

//method for get all feature product in front view
 //public function getFeaturedProduct(){
//$query="SELECT*FROM table_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
//$result=$this->db->select($query);
//return $result;

      //}


      //mthod for new product
//public function getNewProduct(){
//ORDER BY productId DESC LIMIT 4
//$query="SELECT*FROM table_product limit $start_from,$per_page";
//$result=$this->db->select($query);
//return $result;



     // }

//method for get single product
public function getSingleProduct($id){

$query="SELECT p.*,c.catName,b.brandName
FROM  table_product as p, table_cat as c, table_brand as b
WHERE p.catId=c.catId AND p.brandId=b.brandId AND p.productId='$id'";
$result=$this->db->select($query);

    return $result;


      }




      //mthd for get latest product
  public function latestFromIphone(){
$query="SELECT*FROM table_product   WHERE   brandId='25' ORDER BY productId DESC LIMIT 1";
$result=$this->db->select($query);
return $result;
      }    


      //mthd for get latest product
  public function latestFromSamsung(){
$query="SELECT*FROM table_product   WHERE   brandId='21' ORDER BY productId DESC LIMIT 1";
$result=$this->db->select($query);
return $result;
      }    

      //mthd for get latest product
  public function latestFromAcer(){
$query="SELECT*FROM table_product   WHERE   brandId='18' ORDER BY productId DESC LIMIT 1";
$result=$this->db->select($query);
return $result;
      }    

      //mthd for get latest product
  public function latestFromCanon(){
$query="SELECT*FROM table_product   WHERE   brandId='19' ORDER BY productId DESC LIMIT 1";
$result=$this->db->select($query);
return $result;
      }    

//method for get product by id
 public function productByCat($id){
$catId=mysqli_real_escape_string($this->db->link,$id);
$query="SELECT*FROM table_product  WHERE catId='$catId'";
$result=$this->db->select($query);
return $result;

      }




//mthod for product compare
public function insertCompareData($cmprid,$cmrId){
//sanitization
$cmrId=mysqli_real_escape_string($this->db->link,$cmrId);
$productId=mysqli_real_escape_string($this->db->link,$cmprid);
//fr chck addd to compa
$cquery="SELECT*FROM   table_compare  WHERE cmrId='$cmrId'  AND productId='$productId'";
$check=$this->db->select($cquery);
if ($check) {
  $msg="<span  class='success' style='color:red;'>All ready added</span>";
  return $msg;
    }
//for addd to compare
$query="SELECT*FROM   table_product  WHERE productId='$productId'";
$result=$this->db->select($query)->fetch_assoc();
if ($result) {
    $productId=$result['productId'];
    $productName=$result['productName']; 
    $price=$result['price'];
    $image=$result['image'];
$query="INSERT INTO  table_compare(cmrId,productId,productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
$insert_row=$this->db->insert($query);
if ($insert_row) {
$msg="<span  class='success' style='color:#5C3183;'>Added to compare</span>";
  return $msg;
}else{
$msg="<span  class='error'>Not Added</span>";
  return $msg;
      }
       }
   }
//meethd for get compare data
  public function getCompareData($cmrId){
$cmrId=mysqli_real_escape_string($this->db->link,$cmrId);
$query="SELECT*FROM table_compare  WHERE cmrId='$cmrId' ORDER BY id DESC";
$result=$this->db->select($query);
return $result;
   }
//method for dell compare data
   public function delCompareData($cmrId){
     $query="DELETE FROM table_compare WHERE cmrId='$cmrId'";
    $deldata=$this->db->delete($query);
   }


//method for save wlist data
   public function saveWishListData($id,$cmrId){
    //method for check already save wishlist

$cquery="SELECT*FROM   table_wlisht  WHERE cmrId='$cmrId'  AND productId='$id'";
$check=$this->db->select($cquery);
if ($check) {
  $msg="<span  class='success' style='color:red;'>All ready added in wishlist</span>";
  return $msg;
    }
   $pquery="SELECT * FROM table_product WHERE productId='$id'";
    $result=$this->db->select($pquery)->fetch_assoc();
     if ($result) {
     $productId=$result['productId'];
     $productName=$result['productName'];
     $price=$result['price'];
     $image=$result['image'];
     $query="INSERT INTO  table_wlisht (cmrId,productId,productName,price,image) VALUES('$cmrId','$productId','$productName','$price','$image')";
     $insertd_row=$this->db->insert($query);
      if ($insertd_row) {
      $msg="<span  class='success' style='color:green;'>Added !Check Wishlist Page</span>";
      return $msg;
      }else{
      $msg="<span  class='error'>Not Added</span>";
       return $msg;

      }


        }

      }
//methdod for check wishlist data

public function checkWishlistData($cmrId){
$query="SELECT*FROM table_wlisht  WHERE cmrId='$cmrId' ORDER BY id DESC";
$result=$this->db->select($query);
return $result;
      }

//method for delete wishlist  data
 public function delWlistData($productId,$cmrId){
$query="DELETE FROM table_wlisht WHERE productId='$productId' AND cmrId='$cmrId'";

$deldata=$this->db->delete($query);

if ($deldata) {

$msg="<p style='color:green;'>Wishlist data is deleted Successfully</p>";
return $msg;
}else{
$msg="Wishlist data not deleted ";
return $msg;
}
}


//method for get acer product
public function getAcerProduct(){

$query="SELECT*FROM table_product  WHERE type='0'  LIMIT 4";
$result=$this->db->select($query);
return $result;
    }
//method for get samsung product
    public function getSmasungProduct(){
$query="SELECT*FROM table_product  ORDER BY productId DESC LIMIT 4";
$result=$this->db->select($query);
return $result;



    }
//method for get canon product
public function getCanonProduct(){

$query="SELECT*FROM table_product  WHERE type='1' LIMIT 4";
$result=$this->db->select($query);
return $result;

    }
//method for get latest product
    public function getlatestProduct(){
$query="SELECT*FROM table_product  ORDER BY productId DESC LIMIT 4";
$result=$this->db->select($query);
return $result;
    }

  public function getlatestAcerProduct(){
$query="SELECT*FROM table_product  ORDER BY productId DESC LIMIT 4";
$result=$this->db->select($query);
return $result;
    }
}


?>
