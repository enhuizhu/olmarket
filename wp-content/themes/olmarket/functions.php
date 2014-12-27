<?php
/**
* all theme functions will be included here
**/

/**
* should start the session if on the page
* the session not started
**/
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}



/**
* function to check current language
**/
if(!function_exists("getCurrentLanguage")){
  function getCurrentLanguage(){
    
  }
}


/**
* function to load different page template
**/
if(!function_exists("getPage")){
	function getPage($pageName){
    global $langs;
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
        global $langs;
        $nav = array(
           "/" => $langs["home"],
           "blog"=>$langs["blog"],            
           "about"=>$langs["about"],            
           "services"=>$langs["services"],            
           "contact"=>$langs["contact_us"]            
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