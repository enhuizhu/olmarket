<?php
 /**
 * all the function that manipulate data will be here
 **/
 
 /**
* db quotes
**/
if(!function_exists("dbQuotes")){
  function dbQuotes($value){
   return "'".$value."'";
  }
}

 class milkDataModel{
    public $db=null;
    public $errors=array();
	function __construct(){
       global $wpdb;
	   $this->db=$wpdb;
	}	
		
	/**
	* model function to add user to the database
	**/
    
	public function addUser($var){
	  $sql="insert into clientInfo (userName,homeAddress,email,phoneNumber) values (";
	  $sql.=dbQuotes($var["userName"]).",";
	  $sql.=dbQuotes($var["homeAddress"]).",";
	  $sql.=dbQuotes($var["email"]).",";
	  $sql.=dbQuotes($var["phoneNumber"]).")";
	  $result=$this->db->query($sql);
	  return $result;
	}
	
	/**
	* model function to get all the users from database
	**/
	public function getUsers(){
	   $sql="select * from clientInfo";
	   $results=$this->db->get_results($sql);
	   return $results;
	}
	
	/**
	*function to update user infomation
	**/
	public function updateUser($var){
	   $sql="update clientInfo set userName=".dbQuotes($var["userName"]);
	   $sql.=",homeAddress=".dbQuotes($var["homeAddress"]);
	   $sql.=",email=".dbQuotes($var["email"]);
	   $sql.=",phoneNumber=".dbQuotes($var["phoneNumber"]);
	   $sql.=" where userId=".dbQuotes($var["userId"]);
	   //echo "sql is:$sql";
	   return $this->db->query($sql);
	}
	
	/**
	* function to delete userinfo
	**/
	public function deleteUser($userId){
	   $sql="delete from clientInfo where userId=".dbQuotes($userId);
	   return $this->db->query($sql);
	}
	
	
	/**
	* should check if the parcel already exsit or not
	**/
	public function isParcelExist($parcelId){
	   $sql="select * from parcelsId where parcelId=".dbQuotes($parcelId);
	   $result=$this->db->get_row($sql);
	   return empty($result)?false:true;
	 }
	
	/**
	* add new parcel 
	**/
	public function addNewParcel($var){
	   if($this->isParcelExist($var["parcelId"])){
	       $this->errors["parcelExsit"]=$var["parcelId"]." already exsit";
		   return false;
	   }
	   
	   //var_dump($var);
	   
	   if(empty($var["UserId"]) || empty($var["parcelId"])){
	      $this->errors["completeForm"]="please complete the form!";
		   return false;
	   }
	   
	   $sql="insert into parcelsId (userId,parcelId,price,p_date,note,cost) values (";
	   $sql.=dbQuotes($var["UserId"]).",";
	   $sql.=dbQuotes($var["parcelId"]).",";
	   $sql.=dbQuotes($var["price"]).",";
	   $sql.=dbQuotes($var["p_date"]).",";
	   $sql.=dbQuotes($var["note"]).",";
	   $sql.=dbQuotes($var["cost"]).")";
	   
	   if($this->db->query($sql)){
	       return true;
	   }else{
	       $this->errors["dbErr"]="database error happen!";
		   return false;
	   }
	}	
	/**
	* get all the parcel id with user name
	**/
	public function getAllParcels($parcelId=null){
	    $sql="select * from parcelsId as a left join clientInfo as b ";
		$sql.="on a.userId=b.userId";
		if($parcelId!=null){
		    $sql.=" where a.parcelId=".dbQuotes($parcelId);
		    $result=$this->db->get_row($sql);
			return $result->userName;
		}
		$sql.= " order by a.p_date desc";
	    return $this->db->get_results($sql);
	}
	
	/**
	* function to delete the parcel
	**/
	public function deleteParcel($parcelId){
	    $sql="delete from parcelsId where parcelId=".dbQuotes($parcelId);
		return $this->db->query($sql);
	}

    
    /**
    * function to update the parcel which parcel id is $parcelid
    **/	
	public function updateParcel($var){
		$sql = "update parcelsId set price=" . dbQuotes($var["price"]);
		$sql.= ", p_date = " . dbQuotes($var["p_date"]);
		$sql.= ", note = " . dbQuotes($var["note"]);
		$sql.= ", cost = " . dbQuotes($var["cost"]);
		$sql.= " where parcelId = " . dbQuotes($var["parcelId"]);

		// echo "sql is:$sql";

		return $this->db->query($sql);
	}
	
	
	
 }
 
 
 
