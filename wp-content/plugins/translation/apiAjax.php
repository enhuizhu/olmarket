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

//function to delete specific lang
add_action("wp_ajax_deleteLang", "deleteLang");
add_action("wp_ajax_nopriv_deleteLang", "deleteLang");
if(!function_exists("deleteLang")){
        function deleteLang(){
               //echo "the data i get:";
               //die(var_dump($_POST));
               global $myModel;
               $result = $myModel->deleteLang($_POST["langId"]);
               if($result){
                $response=array("success"=>true);
               }else{
                $response=array("success"=>false,"message"=>"Some sql error happen!");
               }
               echo json_encode($response);
               die();
        }
}

//function to delete specific lang
add_action("wp_ajax_createLang", "createLang");
add_action("wp_ajax_nopriv_createLang", "createLang");
if(!function_exists("createLang")){
        function createLang(){
               global $myModel;
               $result = $myModel->addNewLangKey($_POST);               
               //die(var_dump($result));

               if($result){
                $response=array("success"=>true);
                /**
                * should return new lang keys
                **/
                //include($result);
                $response["langs"]=$result;               
               }else{
                $response=array("success"=>false,"message"=>$myModel->error);
               }
               echo json_encode($response);
               die();
        }
}

//function to delete specific lang
add_action("wp_ajax_getLangKeys", "getLangKeys");
add_action("wp_ajax_nopriv_getLangKeys", "getLangKeys");
if(!function_exists("getLangKeys")){
        function getLangKeys(){
               global $myModel;
               $result = $myModel->getLangKeys($_POST["langId"]);               
               echo json_encode($result);
               die();
        }
}


//function to delete lang key
add_action("wp_ajax_deleteLangKey", "deleteLangKey");
add_action("wp_ajax_nopriv_deleteLangKey", "deleteLangKey");
if(!function_exists("deleteLangKey")){
        function deleteLangKey(){
               global $myModel;
               $myModel->deleteLangKey($_POST["langKeyId"]);               
               $result = $myModel->getLangKeys($_POST["langId"]);
               echo json_encode($result);
               die();
        }
}

//function to update the lang value
add_action("wp_ajax_updateLangKeyVal", "updateLangKeyVal");
add_action("wp_ajax_nopriv_updateLangKeyVal", "updateLangKeyVal");
if(!function_exists("updateLangKeyVal")){
        function updateLangKeyVal(){
               global $myModel;
               //die(var_dump($_POST));
               if($myModel->updateLangKeyVal($_POST)){
                 $response = array("success"=>true);
               }else{
                 $response = array("success"=>false,"message"=>"sql error");
               }
               echo json_encode($response);               
               die();
        }
}
