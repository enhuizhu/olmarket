<?php
/**
* all the functions that related to ajax request 
* will come here
**/

add_action("wp_ajax_addNewLang", "addNewLang");
add_action("wp_ajax_nopriv_addNewLang", "addNewLang");
if(!function_exists("addNewLang")){
	   function addNewLang(){
	           //die(var_dump($_POST));
               global $myModel;
               if($myModel->addNewLang($_POST)){
               	  $response = array("success"=>true);
               }else{
               	  $response = array("success"=>false, "message"=>$myModel->error);
               }
               echo json_encode($response);
               die();
	   }
}

//function got get list of langs
add_action("wp_ajax_getLangs", "getLangs");
add_action("wp_ajax_nopriv_getLangs", "getLangs");
if(!function_exists("getLangs")){
        function getLangs(){
                //die(var_dump($_POST));
               global $myModel;
               $response = $myModel->getLangs();
               echo json_encode($response);
               die();
        }
}

