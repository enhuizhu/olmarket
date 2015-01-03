<?php
/**
* all the functions that related to ajax request 
* will come here
**/

add_action("wp_ajax_addNewImage", "addNewImage");
add_action("wp_ajax_nopriv_addNewImage", "addNewImage");
if(!function_exists("addNewImage")){
	   function addNewImage(){
               //var_dump($_FILES["carouselImg"]);
	             //die(var_dump($_POST));
               global $carouselModel;
               if($carouselModel->addNewImage($_POST)){
               	  $response = array("success"=>true,"carouselData"=>$carouselModel->getCarouselData());
               }else{
               	  $response = array("success"=>false, "message"=>$carouselModel->error);
               }
               echo json_encode($response);
               die();
	   }
}

add_action("wp_ajax_getCarouselData", "getCarouselData");
add_action("wp_ajax_nopriv_getCarouselData", "getCarouselData");
if(!function_exists("getCarouselData")){
     function getCarouselData(){
               global $carouselModel;
               echo json_encode($carouselModel->getCarouselData());
               die();
     }
}

add_action("wp_ajax_updateCarousel", "updateCarousel");
add_action("wp_ajax_nopriv_updateCarousel", "updateCarousel");
if(!function_exists("updateCarousel")){
     function updateCarousel(){
               //die(var_dump($_POST));
               global $carouselModel;
               if($carouselModel->updateCarousel($_POST)){
                   $response=array("success"=>true);
               }else{ 
                   $response=array("success"=>false,"message"=>"sql error!");
               }
               echo json_encode($response);
               die();
     }
}

add_action("wp_ajax_deleteCarousel", "deleteCarousel");
add_action("wp_ajax_nopriv_deleteCarousel", "deleteCarousel");
if(!function_exists("deleteCarousel")){
     function deleteCarousel(){
               //die(var_dump($_POST));
               global $carouselModel;
               if($carouselModel->deleteCarousel($_POST)){
                   $response=array("success"=>true);
               }else{ 
                   $response=array("success"=>false,"message"=>"sql error!");
               }
               echo json_encode($response);
               die();
     }
}

