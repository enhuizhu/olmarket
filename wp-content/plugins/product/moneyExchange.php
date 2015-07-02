<?php
/**
* class for money exchange
**/

interface exchange{
	
    //private $rates;
	
	function getRate($type);
	
    function getMoneySymbol($type);
   
	function getActualMoneyValue($type,$value);

}



class moneyExchange implements exchange{
	
    private $rates;

    function __construct(){

      $this->rates = array(
      	 
      	 'pound' => array("sign"=>"&pound;","rate"=>1),

      	 'rmb' => array("sign"=>"&yen;","rate"=>10),   
      	
      	);

    }


    public function getRate($type){
       
       return empty($this->rates[$type]) ? 0 : $this->rates[$type]["rate"];    

    }

    public function getMoneySymbol($type){
   
       return empty($this->rates[$type]) ? "not found" : $this->rates[$type]["sign"];
    
    }


    public function getActualMoneyValue($type,$value){

        return $this->getMoneySymbol($type).($this->getRate($type)*$value);
    }


}


