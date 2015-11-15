<?php
 /**
 * view class to display specific php 
 **/
 class milkView{
    private $vars;
	function __construct(){
	   $this->vars=array();
	}
	
	
	public function assign($key,$value){
	   $this->vars[$key]=$value;
	}
	
	public function display($page){
		extract($this->vars);
	    include("view/$page.php");
	}
	
 }