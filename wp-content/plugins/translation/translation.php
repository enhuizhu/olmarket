<?php
/*
Plugin Name: Translation
Pligin URI: http://www.olmarket.co.uk
Description: This a plugin to translate wordpress to multiple languages.
Author: Enhui Zhu
version: 1.0
Author URI: http://www.olmarket.co.uk
*/


#include datamodel
include "functions.php";
include "view.php";
include "dataModel.php";
getCurrentLang();

#include related lang file
include "langs/".$_SESSION["current_lang"]."/lang.php";
// die(var_dump($langs));
// die(var_dump($_SESSION["current_lang"]));

$myModel = new dataModel();
$myView = new view();

include "apiAjax.php";

#include unit test file
//include "unitTest.php";



function clients_admin_action(){
       add_menu_page("Translation", "Translation", 1, "Translation", "translation_admin");
}
 
add_action('admin_menu', 'clients_admin_action');

function translation_admin(){
    global $myView;
    global $myModel;
    
    if(!$myModel->createLangsTable()){
      die("can not create langs table!");	
    }
    
    if(!$myModel->createLangKeyTable()){
      die("can not create lang key table!");
    }
    
    if(!$myModel->createLangValTable()){
      die("can not create lang val table!");
    }


    $myView->display("index");
}
