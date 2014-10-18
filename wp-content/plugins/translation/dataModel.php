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
* dataModel.php
* all the function related to database will come here
**/
class dataModel{
	public $db;
  public $error;
	function __construct(){
        global $wpdb;
		$this->db = $wpdb;
	}

   /**
   * function to add new lang to the table
   **/
   public function addNewLang($var){
       /**
       * should check if the lang already there
       **/
       if($this->isLangExist($var["lang"])){
           $this->error = $var["lang"]." already exist!";
           return false;  
       }

       /**
       * everything is fine should add the new lang value to the database
       **/
       $sql = "insert into langs (lang) values (".dbQuotes($var["lang"]).")";
       if($this->db->query($sql)){
           return true;
       }else{
           $this->error = "There is a database error happen when try to add new lang to database";
           return false;
       }
   }

   /**
   * function to check if the lang already in the table
   **/
   public function isLangExist($lang){
      $sql = "select count(*) as n from langs";
      $sql.= " where lang=".dbQuotes($lang);
      $result = $this->db->get_row($sql);
      return $result->n >0?true:false; 
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
    * function to create lang table
    **/
    public function createLangsTable(){
        
        if($this->isTableExsit("langs")) return true;
        
        $sql="CREATE TABLE langs(
             lang_id int(2) AUTO_INCREMENT,
             lang varchar(2),
             PRIMARY KEY (lang_id)
          );";
        
        return $this->db->query($sql);
   }

   /**
   * function to create the lang key -> value table 
   * it should also related to the lang table it will 
   * get its lang id
   **/
   public function createLangKeyTable(){
        if($this->isTableExsit("lang_key")) return true;
        $sql = "CREATE TABLE lang_key(
              lang_key_id int(5) AUTO_INCREMENT,
              lang_key varchar(100),
              lang_value text,
              lang_id int(2),
              PRIMARY KEY (lang_key_id)
         );";
        return $this->db->query($sql);
    }

    //function to get the list of langs
    public function getLangs(){
        $sql="select * from langs";
        return $this->db->get_results($sql);
    }
}
