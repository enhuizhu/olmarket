"use strict";

angular.module("olmarket.translation").controller("addNewLangCtrl",function($scope,$http,$rootScope,errorHandler,callsApi){

   var that = this;
	 this.$ = $scope;
	 this.$.lang="";
    
   this.$.addNewLang = function(){
    	$rootScope.isLoading = true;
    	if(that.$.lang==""){
    		alert("The value of new lang can not be empty!");
    		return false;
    	}
      
      var data = "lang="+that.$.lang+"&action=addNewLang";
    	$http.post(ajaxUrl,data).success(function(data){
            if(!data.success){
               errorHandler.generateError(data.message,$scope);
               $rootScope.isLoading=false;
            }else{
               $rootScope.getLangs();
            }
            
    	}).error(function(e){
    		console.log(e);
    	});
     };
     
     
     //functions to delete specific lang
     this.$.deleteLangBaseOnId = function(langId){
        var result = confirm("Do you really want to delete this lang and its related lang keies?");
        if(!result) return;
        var data = "action=deleteLang&langId="+langId;
        $rootScope.isLoading=true;
        $http.post(ajaxUrl,data).success(function(data){
          console.log(data);
          $rootScope.getLangs();
        });
     }
});
