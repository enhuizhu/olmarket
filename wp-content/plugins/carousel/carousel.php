<?php
/*
Plugin Name: Carousel
Pligin URI: http://www.olmarket.co.uk
Description: This a plugin for carousel
Author: Enhui Zhu
version: 1.0
Author URI: http://www.olmarket.co.uk
*/


include "view.php";
include "dataModel.php";

$carouselModel = new carouselModel();
$carouselView = new carouselView();

include "apiAjax.php";


function carousel_admin_action(){
       add_menu_page("Carousel", "Carousel", 1, "Carousel", "carousel_admin");
}
 
add_action('admin_menu', 'carousel_admin_action');

function carousel_admin(){
    global $carouselView;
    global $carouselModel;
    $carouselView->display("index");
}
