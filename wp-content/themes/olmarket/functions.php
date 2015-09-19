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
           "blog"=> $langs["blog"],
           "portfolios" => $langs["portfolios"],            
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
* function to get portfolio side bar
**/
if (!function_exists("getPortfolioSideBar")) {
   function getPortfolioSideBar(){
     /**
     * This is regular php template file
     **/
      $portfolios = array();

      $type = 'portfolio';
      $args=array(
        'post_type' => $type,
        'post_status' => 'publish',
        // 'posts_per_page' => 10,
        'caller_get_posts'=> 1
      );

      $my_query = null;
      $my_query = new WP_Query($args);
      if( $my_query->have_posts() ) {
        while ($my_query->have_posts()) {
            $my_query->the_post();
            $category = get_the_category()[0]->name;

            if (!isset($portfolios[$category])) {
                $portfolios[$category] = array();  
            }

            array_push($portfolios[$category], array(
                "title" => get_the_title(),
                "date" => get_the_date(),
                "content" => get_the_content(),
                "link" => get_the_permalink()
            ));
        }
      }

      wp_reset_query();  // Restore global post data stomped by the_post().

      return $portfolios;

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


/**
* function to display part of the rext
**/
if (!function_exists("brifContent")) {
    function brifContent($content ,$maxStringNumber = 300){
        if (strlen($content) >  $maxStringNumber) {
            $contentAfterCut = strip_tags(substr($content, 0, $maxStringNumber));
            $contentAfterCut .= "...";
            return $contentAfterCut;
        }

        return $content;
    }
}


function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }

  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}

