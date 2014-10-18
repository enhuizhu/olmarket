<?php
/**
* basic view class 
**/

class view{
    /**
    *  @data, varible to save all the varibles which will 
    *  be passed to the view file 
    */
    private $data;
    
    private $viewPath;

    
    function __construct(){
         $this->data= array();
         $this->viewPath = dirname(__FILE__);
    }


    public function getViewPath(){
        return $this->viewPath;
    } 

    /**
    * function to put varible into array
    **/
    public function assign($key,$var){
    	$this->data[$key]=$va;
    }


    /**
    * function to display the the view
    **/
    public function display($fileName){
    	extract($this->data);
        include $this->viewPath."/view/".$fileName.".php"; 
    }
    
}