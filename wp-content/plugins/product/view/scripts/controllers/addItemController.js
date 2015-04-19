/**
* addItemController
**/

foodMenu.controller("addItemController",function($scope,$rootScope,api){

    if($rootScope.categoryList==undefined){
        api.getCategory();
    }
    
    $scope.addNewItem=function(){
       /**
       * should check if user input valid data
       **/
       var error = "";
       var condition1= $scope.product == undefined;
       try{
          var condition2 = $scope.product.name==undefined || $scope.product.name=="" || $scope.product.price=="";
       }catch(e){
       	  var condition2 = false;
       }

       var priceExp = /^\d+\.\d{2}$/;

       console.log("product is:",$scope.product);


       if(condition1 || condition2){
           error = "please complete the form!";
       }else if(!priceExp.test($scope.product.price)){
       	   error = "invalid price formate, it should be something like 99.99";
       }

       if(error != ""){
       	  alert(error);
       	  return false;
       }

       var data = "action=addNewItem&cid="+$scope.product.cid;
       data += "&productName="+$scope.product.name;
       data += "&productPrice="+$scope.product.price;
       
       api.call(data,function(data,status){
            alert(data.message);
            if(!data.error){
            	$scope.product.name="";
            	$scope.product.price="";
            }
       });
    }
});