<?php
/**
* all the helper functions will be here
**/
function getCurrentLang(){
  /**
  * should check if there is any query string related
  * to lang_select
  **/
  session_start();
  
  if(isset($_GET["lang_select"])){
     $_SESSION["current_lang"]=$_GET["lang_select"];
  }

  if(!isset($_SESSION["current_lang"])){
  	 $_SESSION["current_lang"]="en";
  }

  return $_SESSION["current_lang"];
}





