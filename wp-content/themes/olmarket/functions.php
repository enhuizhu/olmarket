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
        // die(var_dump($langs));
        $nav = array(
           "/" => $langs["home"],
           "blog"=>$langs["blog"],            
           // "about"=>$langs["about"],            
           // "services"=>$langs["services"],            
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

/**
* function to generate the category
**/

if (!function_exists("categorySideBar")) {
  
  function categorySideBar(){
      $taxonomy     = 'product_cat';
      $orderby      = 'name';  
      $show_count   = 0;      // 1 for yes, 0 for no
      $pad_counts   = 0;      // 1 for yes, 0 for no
      $hierarchical = 1;      // 1 for yes, 0 for no  
      $title        = '';  
      $empty        = 0;
      $args = array(
       'taxonomy'     => $taxonomy,
       'orderby'      => $orderby,
       'show_count'   => $show_count,
       'pad_counts'   => $pad_counts,
       'hierarchical' => $hierarchical,
       'title_li'     => $title,
       'hide_empty'   => $empty
     );
    
     $all_categories = get_categories( $args );
     //print_r($all_categories);
     foreach ($all_categories as $cat) {
        //print_r($cat);
        if($cat->category_parent == 0) {
            $category_id = $cat->term_id;
            echo '<br /><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>';
            $args2 = array(
              'taxonomy'     => $taxonomy,
              'child_of'     => 0,
              'parent'       => $category_id,
              'orderby'      => $orderby,
              'show_count'   => $show_count,
              'pad_counts'   => $pad_counts,
              'hierarchical' => $hierarchical,
              'title_li'     => $title,
              'hide_empty'   => $empty
            );
            $sub_cats = get_categories( $args2 );
            if($sub_cats) {
                foreach($sub_cats as $sub_category) {
                    echo  $sub_category->name ;
                }

            } 
        }     
    }
  }
}

