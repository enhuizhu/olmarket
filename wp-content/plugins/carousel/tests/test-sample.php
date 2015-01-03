<?php

class SampleTest extends WP_UnitTestCase {

	function testSample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

    /**
    * function to test if it can init carousel table properly
    **/
    function testCarouselTable(){

    	$plugins_url = dirname(__FILE__);
    	echo "plugin url is:$plugins_url\n";
    	$fileName = basename("test/test/fkjadls.png");
    	echo "base name is:$fileName\n";
        $myModel = new carouselModel();
        $myModel->initCarouselTable();
        $this->assertTrue($myModel->isTableExsit("carousel"));
    }

}

