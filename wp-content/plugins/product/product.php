<?php
/*
Plugin Name: Product
Plugin URI: http://www.olmarket.co.uk
Description: plugin to manage products
Version: 1.0
Author URI: http://www.olmarket.co.uk
*/


include "view.php";
include "dataModel.php";
include "api.php";

$proView = new productView();
$proModel= new productModel();

$proModel->createProductCategoryTable("product_catogory");
$proModel->createProductsTable("createProductsTable");


include "displayProducts.php";

$displayProducts = new displayProducts();


function products_admin_action(){
       add_menu_page("Products Management", "Products Management", 1, "Products Management", "product_admin");
}
 
add_action('admin_menu', 'products_admin_action');


function product_admin(){
    global $proView;
    global $proModel;
    $proView->display("index");
}







