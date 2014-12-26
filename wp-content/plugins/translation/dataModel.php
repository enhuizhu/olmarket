<?php
/**
* db quotes
**/
if(!function_exists("dbQuotes")){
  function dbQuotes($value){
   global $wpdb;
   return "'".($value)."'";
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
   * function to create lang_val table
   **/
   public function createLangValTable(){
        if($this->isTableExsit("lang_vals")) return true;
        $sql="CREATE TABLE lang_vals(
           val_id int(4) AUTO_INCREMENT,
           lang_key_id int(3),
           lang_id int(3),
           lang_value text,
           PRIMARY KEY (val_id) 
        )";
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

    //function to delete specific lang base on lang id
    public function deleteLang($langId){
        $sql = "delete from langs where lang_id=".dbQuotes($langId);
        return $this->db->query($sql);
    } 
    
    public function isLangKeyExist($langKey,$langId){
       $sql="select count(*) as n from lang_key where";
       $sql.=" lang_key=".dbQuotes($langKey);
       $sql.=" and lang_id=".dbQuotes($langId);
       $result = $this->db->get_row($sql);
       return $result->n>0?true:false;
    }

    /**
    * function to add new lang key to the database, and base on 
    * different lang write new lang key value to a file
    **/
      public function addNewLangKey($var){
       /**
       * should check if the lang_key already exist
       **/
       if ($this->isLangKeyExist($var["langKey"],$var["langId"])) {
          $this->error=$var["langKey"]." already exist!";
          return false;
       }


       $sql= "insert into lang_key (lang_key)";
       $sql.=" values (";
       $sql.=dbQuotes($var["langKey"]);
       //$sql.=dbQuotes($var["langId"]);
       $sql.=")";

      //die(var_dump($sql));
        
       if($this->db->query($sql)){
          $latestId = $this->db->insert_id;
          $this->inserNewLangValue($latestId,$var["langId"],$var["langVal"]);
          $this->writeLangKeyToFile($var["langId"]);
          return $this->getLangKeys($var["langId"]);
       }else{
          $this->error = "sql insert error";
          return false;
       }
    }

  /**
  * function to insert new lang value
  **/
    public function inserNewLangValue($langKeyId,$langId,$langVal){
       /**
          * should write new values to lang vals table
          **/
          $sql="insert into lang_vals (lang_key_id,lang_id,lang_value)";
          $sql.=" values (";
          $sql.=dbQuotes($langKeyId).",";
          $sql.=dbQuotes($langId).",";
          $sql.=dbQuotes($langVal).")";
          return $this->db->query($sql); 
    }

    /**
   * function to print out the lang keys
   **/
   function getLangKey($langId){
    $sql="select * from lang_key where lang_id=".dbQuotes($langId);
    $result = $this->db->get_results($sql);
    return $result;
   }
    

    /**
    * function to write new lang key to a file, base on 
    * lang id
    **/
    public function writeLangKeyToFile($langId){
        /**
        * get all the lang key value from database base
        * on lang id
        **/
        $sql = "select * from lang_key as a";
        $sql.= " left join (select * from lang_vals where lang_id=".dbQuotes($langId);
        $sql.= ") as b";
        $sql.=" on a.lang_key_id=b.lang_key_id";
        $result = $this->db->get_results($sql);
        /**
        * should check if the specific lang folder is already 
        **/
        $currentPath = realpath(dirname(__FILE__));
        /**
        * should get the lang value base on lang id
        **/      
        $sql = "select * from langs where lang_id=".dbQuotes($langId);
        $lang= $this->db->get_row($sql);

        $langForlder = $currentPath."/langs/".$lang->lang;
        if(!file_exists($langForlder)){
         /**
         * if folder not exist, should create it first
         **/
         mkdir($langForlder);
        }
        $content="<?php\n";
        $content.='$langs=array();'."\n";
        foreach($result as $k=>$v){
         $content.='$langs["'.$v->lang_key.'"]="'.$v->lang_value.'";'."\n";
        }
        $content.="?>";
        //die(var_dump($content));
        /**
        * everyting is fine, should write the content to file
        **/
        $langFile = $langForlder."/lang.php";
        file_put_contents($langFile,$content);
        return $langFile;
    }

     /**
     *  function to get all the lang keys
     **/
     public function getLangKeys($langId){
        $sql = "select *,a.lang_key_id as key_id from lang_key as a";
        $sql.= " left join (select * from lang_vals where lang_id=".dbQuotes($langId);
        $sql.= ") as b";
        $sql.=" on a.lang_key_id=b.lang_key_id";
        $resultes = $this->db->get_results($sql);
        return $resultes;
     }

     /**
     * function to delete lang key
     **/
      public function deleteLangKey($langKeyId){
        /**
        * should delete all the records whose lang key id is $langKeyId
        **/
        $sql = "delete from lang_key where lang_key_id=".dbQuotes($langKeyId);
        $this->db->query($sql);
        $sql = "delete from lang_vals where lang_key_id=".dbQuotes($langKeyId);
        $this->db->query($sql);

        /**
        * should rewrite all the lang files
        * should get all the lang id first
        **/
        $sql="select * from langs";
        $resultes = $this->db->get_results($sql);
        foreach ($resultes as $key => $value) {
          $this->writeLangKeyToFile($value->lang_id);
        }
      }

      /**
      * function to update lang value
      **/
      public function updateLangKeyVal($var){
        /**
        * should check the value of valId
        **/
        //die(var_dump($var["valId"]=="null"));
        if($var["valId"]=="null"){
          $this->inserNewLangValue($var["keyId"],$var["langId"],$var["value"]);
        }else{
          $sql = "update lang_vals set lang_value=".dbQuotes($var["value"]);
          $sql .= "where val_id=".dbQuotes($var["valId"]);
          $this->db->query($sql);
        }
        /**
        * rewrite new value to file
        **/
        $this->writeLangKeyToFile($var["langId"]);
        return true;
      }
  
  }
