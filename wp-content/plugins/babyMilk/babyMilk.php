<?php
/*
Plugin Name: Baby Milk
Plugin URI: http://www.olmarket.co.uk
Description: this plugin will provide a user interface for people to track their parcel
Author: david zhu
Version: 1.6
Author URI: http://www.olmarket.co.uk
*/

/**
* include all the necessary files
**/
include "dataModel.php";
include "installBabyMilk.php";
include "view.class.php";
include "simple_html_dom.php";
include "cms.php";

$myDb = new milkDataModel();

/**
* should check if in the database already have the parcel table
**/
if(!isTableExist("clientInfo") || !isTableExist("parcelsId")){
    /**
	* create all the required tables
	**/
    if(!createClientInfoTb() || !createParcelTb()){
       die("error happen when install the milk plugin");	
	}
}

class BabyMilk{
    private $view;
	public $error=null;
	private $remoteUrl=null;
	private $exsitingClient;
	function __construct(){
	    $this->remoteUrl="http://www.p2uexp.com/track_detail.php";
	    $this->exsitingClient=array(
		   "CT312670315CN"=>"林惠芳",
		   "CT312670403CN"=>"胡春华",
		   "CT312632334CN"=>"朱桂官"
		);
		$this->view=new milkView();
	}
	
	
    /**
	* function to output the basic interface
	**/
    public function index(){
	   if(isset($_POST["parcelNumber"])){
	      /**
		  * should check if the parcel number is empty 
		  **/
	      if(empty($_POST["parcelNumber"])){
		      $this->error="快递单号不能为空!";
		      $this->view->assign("error",$this->error);
		  }else{
		      global $myDb;
		      $parameters=array(
			     "TN"=>$_POST["parcelNumber"]
			  );
			  //var_dump($myDb);
		      $userName=$myDb->getAllParcels($_POST["parcelNumber"]);
			  //die(var_dump($userName));
			  $result=$this->getResultFromRemote($parameters);
			  $html = str_get_html($result);
			  $useFulContent=$html->find('table', 0);
			  
			  //die(var_dump($useFulContent->outertext));
			  $this->view->assign("userName",$userName);
              $this->view->assign("parcelNumber",$_POST["parcelNumber"]);
			  $this->view->assign("result",$useFulContent->outertext);
		      $this->view->assign("exsitingClient",$this->exsitingClient);
		  }
	   }
        $this->view->display("trackInterface");
	}

    /**
	* get the query result from the remote server
	**/
	public function getResultFromRemote($parameters){
	    $apiUrl=$this->remoteUrl;
	    //echo "api url is:".$apiUrl;
	    $ch = curl_init();
	    $header = array();
        $header[] = 'Content-type: application/x-www-form-urlencoded';
        $header[] = 'Connection: keep-alive';
	    curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch,CURLOPT_URL, $apiUrl);
        $content="";
	    foreach($parameters as $k=>$v){
		   $content.="$k=".urlencode($v)."&";
	    }
	    /*trim the right &*/
	    $content=rtrim($content,"&");
		//die(var_dump($content));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	    $result=curl_exec($ch);
	    return $result;   
	}
	

	
}
$BabyMilkInstance=new BabyMilk();
 
 /**
 * ajax get friend top tippr
 **/
 add_action("wp_ajax_editUser", "editUser");
 add_action("wp_ajax_nopriv_editUser", "editUser");
 
 if(!function_exists("editUser")){
  function editUser(){
     global $myDb;
	 if($myDb->updateUser($_POST)){
	    $response=array("error"=>false,"message"=>"user info has been update successfully!");
	 }else{
	    $response=array("error"=>true,"message"=>"some error happen when try to update the database");
	 }
	 echo json_encode($response);
	 die();
  }
 }
 
  /**
 * ajax get friend top tippr
 **/
 add_action("wp_ajax_deleteUser", "deleteUser");
 add_action("wp_ajax_nopriv_deleteUser", "deleteUser");
 
 if(!function_exists("deleteUser")){
  function deleteUser(){
     global $myDb;
     if($myDb->deleteUser($_POST["userId"])){
	   $response=array("error"=>false,"message"=>"client info has been deleted successfully!");
	 }else{
	   $response=array("error"=>true,"message"=>"some error happend when manipulated database!");
	 }
	 echo json_encode($response);
	 die();
  }
 }


 /**
 * ajax get friend top tippr
 **/
 add_action("wp_ajax_updateParcel", "updateParcel");
 add_action("wp_ajax_nopriv_updateParcel", "updateParcel");
 
 if(!function_exists("updateParcel")){
  function updateParcel(){
  	 // die(var_dump($_POST));
     global $myDb;
     if($myDb->updateParcel($_POST)){
	   $response=array("error"=>false,"message"=>"parcel has been updated successfully!");
	 }else{
	   $response=array("error"=>true,"message"=>"some error happend when manipulated database!");
	 }
	 echo json_encode($response);
	 die();
  }
 }

 
 




