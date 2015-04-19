<?php


/**
* db quotes
**/
if(!function_exists("dbQuotes")){
  function dbQuotes($value){
   global $wpdb;
   return "'".$wpdb->escape($value)."'";
  }
}

/**
* all the function which manipulate the database will be here
**/

class productModel{
	
	  private $db;

    public $error;

    function __construct(){
      global $wpdb;
    	$this->db = $wpdb;
    }

    
    /**
    * function to check if the table exsit
    **/
    public function isTableExsit($table){
    	$sql="show tables like '$table'";
    	$result = $this->db->get_results($sql);
    	return empty($result)?false:true;
    }



    /**
    * function to create product category
    **/
    public function createProductCategoryTable(){
        
        if($this->isTableExsit("product_category")) return true;
        
        $sql="CREATE TABLE product_category(
             category_id int(5) AUTO_INCREMENT,
             category_name varchar(100),
             pos int(5),
             PRIMARY KEY (category_id)
          );";
        
        return $this->db->query($sql);

    }

    /**
    * function to check if the given category already exist
    **/
    public function isCategoryExist($categoryName,$id=null){
        $sql = "select count(*) as n from product_category where category_name=";
        $sql.= $this->dbQuotes($categoryName);
        if($id!=null){
          $sql.=" and category_id!=".$this->dbQuotes($id);
        }
        $result = $this->db->get_row($sql);
        return $result->n >0 ? true: false;
    }

    public function dbQuotes($str){
        return "'".$this->db->escape($str)."'";
    }


    /**
    * function to add new category
    **/
    public function addNewCategory($categoryName){
       /**
       * should check if the category already in the db
       **/
       if($this->isCategoryExist($categoryName)) return true;
       
       $defaultPos = $this->getNewPos();
       
       $sql = "insert into product_category (category_name,pos) values (";
       $sql.= $this->dbQuotes($categoryName).",";
       $sql.= $this->dbQuotes($defaultPos);
       $sql.=")";

       //die($sql);
       return $this->db->query($sql);
    }


    /**
    * function to get the higest id number
    **/
    public function getNewPos(){
      $sql = "select max(category_id)+1 as maxId from product_category";
      $result = $this->db->get_row($sql);
      return $result->maxId;
    }




    /**
    * function to get all the categories
    **/
    public function getAllCategories(){
        $sql = "select * from product_category";
        $results = $this->db->get_results($sql);
        return $results;
    }

    /**
    * function to delete specific category
    **/
    public function deleteCategory($categoryId){
        $sql = "delete from product_category where category_id =";
        $sql.= $this->dbQuotes($categoryId);
        $this->db->query($sql);
        $this->deleteProductUnderCategory($categoryId);
        return $this->getAllCategories();
    }

    /**
    * delete product under specific category
    **/
    public function deleteProductUnderCategory($cid){
        $sql = "delete from products where category_id=".$this->dbQuotes($cid);
        return $this->db->query($sql);
    }

    /**
    * update category name 
    **/
    public function updateCategoryName($cid,$cname,$pos){
         /**
         * should check if the new name already exist
         **/
         if($this->isCategoryExist($cname,$cid)){
            $this->error = "category already exist!";
            return false;
         }
         
         $sql = "update product_category set category_name=";
         $sql.= $this->dbQuotes($cname).",";
         $sql.= "pos=".$this->dbQuotes($pos);
         $sql.= " where category_id=".$this->dbQuotes($cid);
        
         if($this->db->query($sql)){
             return $this->getAllCategories();
         }else{
             $this->error="sql error when update the category name.";
             return false;
         }

    } 
   
    /**
    * function to create products table
    **/
    public function createProductsTable(){
        
        if($this->isTableExsit("products")) return true;
        
        $sql="CREATE TABLE products(
             product_id int(10) AUTO_INCREMENT,
             product_name varchar(100),
             product_price float(8),
             category_id int(5),
             PRIMARY KEY (product_id)
          );";
        
        return $this->db->query($sql);

    }

    /**
    * function to check if the product already exist or not
    **/
    public function isProductExist($productName,$pid=false){
        $sql = "select count(*) as n from products";
        $sql .= " where product_name=".$this->dbQuotes($productName);
        
        if($pid!=false){
          $sql .= " and product_id != ".$this->dbQuotes($pid);
        }

        $result = $this->db->get_row($sql);
        return $result->n > 0 ? true:false;
    }

    /**
    * function to insert new product into product table
    **/
    public function addNewItem($cid,$name,$price){
        if($this->isProductExist($name)){
            $this->error="$name already exist!";
            return false;
        }

        $sql = "insert into products (product_name,product_price,category_id) values (";
        $sql.= $this->dbQuotes($name).",";
        $sql.= $this->dbQuotes($price).",";
        $sql.= $this->dbQuotes($cid).")";
       
        if(!$this->db->query($sql)){
            $this->error="sql error!";
            return false;
        }
        return true;
    }

    /**
    * function to get all the products
    **/
    public function getItems(){
       $sql = "select * from products as a";
       /**
       * should connect it to product category talbe
       **/
       $sql.=" left join product_category as b";
       $sql.=" on a.category_id=b.category_id";
    
       /**
       * should sort it by category id
       **/
       $sql.=" order by b.pos asc";
       return $this->db->get_results($sql);

    }

    /**
    * function to update the product
    **/
    public function updateProduct($productId,$productName,$productPrice){
      //should check if the product name already exist     
      if($this->isProductExist($productName,$productId)){
        $this->error  = "$productName already exist!";
        return false;
      }

      $sql = "update products set product_name=".$this->dbQuotes($productName);
      $sql.= ", product_price=".$this->dbQuotes($productPrice);
      $sql.=" where product_id=".$this->dbQuotes($productId);

      if(!$this->db->query($sql)){
        $this->error="sql error!";
        return false;
      }
       
      return $this->getItems();

    }
    
    /**
    * function to delete the product
    **/
    public function deleteProduct($productId){
       $sql = "delete from products where product_id=".$this->dbQuotes($productId);      
       $this->db->query($sql);
       return $this->getItems();
    }
}
