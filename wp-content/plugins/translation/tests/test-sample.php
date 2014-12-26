<?php

class SampleTest extends WP_UnitTestCase {       
      
      function testLangKeyExist(){
         $myModel = new dataModel();
         $this->assertTrue($myModel->isLangKeyExist("test",11));
         $this->assertFalse($myModel->isLangKeyExist("test",12));
      } 

      function testWriteToFile(){
        $myModel = new dataModel();
        echo "the lang key write to file is:";
        var_dump($myModel->writeLangKeyToFile(11));
       }    
 
}

