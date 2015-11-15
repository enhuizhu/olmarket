<?php 
/**
* all the functions that install database will be here
**/
if(!function_exists("isTableExist")){
   function isTableExist($tableName){
      global $wpdb;
 	  $sql = "show tables like '".$tableName."'";
      $result=$wpdb->get_row($sql);
      //var_dump($result);
	  return empty($result)?false:true;	  
   }
}

/**
* function to create clientInfo table
**/
if(!function_exists("createClientInfoTb")){
   function createClientInfoTb(){
     global $wpdb;
	 $sql="create table if not exists clientInfo ";
     $sql.="(";
	 $sql.="userId int AUTO_INCREMENT PRIMARY KEY,";
	 $sql.="userName varchar(20),";
	 $sql.="homeAddress TINYTEXT,";
	 $sql.="email varchar(20),";
	 $sql.="phoneNumber varchar(20)";
	 $sql.=")COLLATE utf8_general_ci";
	 //echo $sql;
     $result=$wpdb->query($sql);
	 if(!$result){
	     $wpdb->show_errors();
	     return false;
	 }
	 return true;
  }
}

/**
* function to crate parcelsId table
**/
if(!function_exists("createParcelTb")){
   function createParcelTb(){
     global $wpdb;
     $sql="create table if not exists parcelsId ";
	 $sql.="(";
	 $sql.="parcelId varchar(100),";
	 $sql.="userId int";
	 $sql.=")COLLATE utf8_general_ci";
     $result=$wpdb->query($sql);
     if(!$result){
	     $wpdb->show_errors();
	     return false;
	 }
	 return true;
   }
}


