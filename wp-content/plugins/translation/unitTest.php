<?php

if(isset($_GET["plugin_test"])){
#function which is used for unit test
function isEqual($expect,$actual){
    if($expect == $actual){
      return true;
    }else{
      return false;
    }
}
/**
* test the function of isLangExist
**/
if(isEqual(false,$myModel->isLangExist("en"))){
   print("past test!<br>");
}else{
   print("failed test!<br>");
}

#test add new lang function
/*if($myModel->addNewLang(array("lang"=>"en"))){
   print("add new lang successfully.<br>");
}else{
   print($myModel->error);
}*/

die();

}