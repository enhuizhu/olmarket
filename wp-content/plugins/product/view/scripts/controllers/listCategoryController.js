/**
* listCategoryController for foodMenu app
**/

foodMenu.controller("listCategoryController",function($scope,$http,$rootScope,api){
	
    //$scope.categoryList=[];
     //console.log($rootScope.categoryList);
    if($rootScope.categoryList==undefined){
        api.getCategory();
    }


   $scope.delete=function(index){
     
     var shouldDelete= confirm("Do you really want to delete this category and the products under this category?");
     if(!shouldDelete) return false;

     var data="action=deleteCategory&categoryId="+index;
     api.call(data,function(data,status){
              console.log("data",data);        
             /**
             * init categoryList value
             **/
             $scope.categoryList = data;               
     });
   }
 
   $scope.update=function(cid,cname,pos){
     var data="action=updateCategoryName&categoryId="+cid+"&categoryName="+cname+"&pos="+pos;
     //console.log("sending data is:",data);  
     //return false;
     api.call(data,function(data,status){
         if(data.error){
         	alert(data.message);
         }else{
            $scope.categoryList=data;	
         }
     });
   

   }



   //$scope.getCategory();

});