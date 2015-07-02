/**
* listItemsController
**/

foodMenu.controller("listItemsController",function($scope,api){

    $scope.products=[];
    
    var data="action=getItems";
    api.call(data,function(data,status){
      $scope.products=data;
    });
   
    $scope.update=function(pid,pname,price){
    	console.log(pid,pname,price);
        /**
        * should check if pname and price is valid
        **/
        if(pname==""){
           alert("product name can not be empty!");
           return false;
        }else if(!/^\d+\.\d{2,2}$/.test(price)){
           alert("invalid price formate, it should be like 9.99");	
           return false;
        }

        /**
        * every thing is fine shoud connect to the api
        **/
        var data="action=updateProduct";
        data+="&productId="+pid;
        data+="&productName="+pname;
        data+="&productPrice="+price;
        
        api.call(data,function(data,status){
            if(data.error){
            	alert(data.message);
            	return false;
            }
            $scope.products=data;
            //console.log(data);
        });

    }

   $scope.delete=function(productId){
       var shouldDelete = confirm("Do you really want to delete this product?");
       if(!shouldDelete) return false;

       var data="action=deleteProduct";
       data+="&productId="+productId;

       api.call(data,function(data,status){
           $scope.products=data;    
       });
   }
});