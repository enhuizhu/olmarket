<?php
/**
* all theme functions will be included here
**/

/**
* function to load different page template
**/
if(!function_exists("getPage")){
	function getPage($pageName){
		include "contents/templatePage.php";
	}
}


/**
* function to check if the server use https
**/
if(!function_exists("isSecureConnection")){
	function isSecureConnection(){
	  if(isset($_SERVER['HTTPS']) && $_SERVER["HTTPS"] == "on"){
            return true;
        }
      return false;
	}
}


/**
* function to get current url
**/
if(!function_exists("getCurrentUrl")){
   function getCurrentUrl(){
    $http = isSecureConnection()?"https://":"http://";
    return $http . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
   }
}

/**
*  function to check if current nav should be active or not
**/
if(!function_exists("isAcitvePage")){
	function isAcitvePage($pageUri){
		/**
		* should check if the last charater of page uri contains "/"
		* if it not conains "/", shoudl add it to the end
		**/
		$lastCharacter = substr($pageUri, -1);
        if($lastCharacter!="/"){
        	$pageUri.="/";
        }
        $pageUrl = site_url($pageUri);
        return $pageUrl==getCurrentUrl()?true:false;
	}
}

/**
* function to generate the navigation bar
**/
if(!function_exists("nav")){
	function nav(){
		#define the the navigation array
        $nav = array(
           "/" => "HOME",
           "blog"=>"BLOG",            
           "about"=>"ABOUT",            
           "services"=>"SERVICES",            
           "portfolis"=>"PORTFOLIS",            
           "contact"=>"CONTACT US"            
        );
        include "contents/nav.php";
	}
}

/**
* function to generate active class
**/
if(!function_exists("activeClass")){
	function acitveClass($pageUri){
        if(isAcitvePage($pageUri)){
        	echo ' class="active"';
        }
	}
}










