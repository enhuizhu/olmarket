<?php
/**
* class which will be used in frontend to display all the prodcuts
**/

include "moneyExchange.php";

class displayProducts{
   
   private $dataModel;

   private $moneyExchange;
   
   function __construct(){
       
       global $proModel;

       $this->dataModel = $proModel;

       $this->moneyExchange = new moneyExchange();

   }


   private function wrapSinglePro($product){
             return "<div class='pull-left'>
                       <div>".$product->product_name."</div>
                       <div>".$this->moneyExchange->getActualMoneyValue("pound",$product->product_price)."</div>
                     </div>";
   }

   private function wrapSingleCat($category){
   	   return "<li>
                   
               ".$category->category_name."

             </li>";
   }
   
   private function wrapProducts($products){
        
        $contents = "";

        foreach($products as $product){
            $contents .= $this->wrapSinglePro($product);
        }

        $contents .= "<div class='clear'></div>";
        
        return $contents;

   }


   private function wrapCategories($categories){
       
       $contents = "<ul>";

       foreach($categories as $category){
       	  $contents .= $this->wrapSingleCat($category);
       }

       $contents .= "</ul>";

       return $contents;

   }

   public function products(){
   	   
   	   $products = $this->dataModel->getItems();

       echo $this->wrapProducts($products);

   }


   public function categories(){
       
       $categories = $this->dataModel->getAllCategories();

       echo $this->wrapCategories($categories);

   }
}
