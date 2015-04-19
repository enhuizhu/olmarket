<?php

  /**
  * php unit test file here
  **/
  class dataModelTest extends PHPUnit_Framework_TestCase{
    
    /**
    * function to check if table exsit
    **/

    public function testTableExsit(){
         
        $myDataModel = new dataModel();
        

        $myDataModel->isTableExsit("test");

       
        $this->assertEquals(false,$myDataModel->isTableExsit("test"));

        $this->assertEquals(true,$myDataModel->isTableExsit("wp_commentmeta"));

        $this->assertEquals(true,$myDataModel->isTableExsit("wp_comments"));
    }


    
 

  }
  
