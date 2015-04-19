/**
* api service 
**/

foodMenu.service("api",function($http,$rootScope){
   
   this.call=function(requestData,callback){
         $rootScope.isLoading=true;
         $http.post(ajaxUrl,requestData).success(function(data,status){
             callback(data,status);  
          }).error(function(){
         	 alert("error happen when sending the request!");
         }).then(function(){
         	 $rootScope.isLoading=false;
         });
   }


   this.getCategory=function(){
         var data="action=getAllCatogries";
         this.call(data,function(data,status){     
             /**
             * init categoryList value
             **/
             $rootScope.categoryList = data;               
         });
   }    	
});

