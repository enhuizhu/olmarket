/**
* controller to add category
**/

foodMenu.controller("AddCategoryController",function($scope,$http,$rootScope,api){
      
      $rootScope.isLoading=false;

      $scope.createCat=function(){
          //alert("category name is:"+$scope.categoryName);
          var data = "action=addCategory&categoryName="+$scope.categoryName;
          api.call(data,function(data,status){
              $scope.categoryName="";
           	  try{
           	   //var response = JSON.parse(data);
               alert(data.message);
              }catch(e){
              	alert("error:"+e.message);
              }              
          });    
    }
});