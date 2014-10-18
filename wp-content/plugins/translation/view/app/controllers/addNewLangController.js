"use strict";

angular.module("olmarket.translation").controller("addNewLangCtrl",function($scope,$http,$rootScope,$compile){

     var that = this;
	 this.$ = $scope;
	 this.$.lang="";


     //varible to save the list of lang
     this.$.langList=[];
     
     //function to get the list of langs
     this.getLangs = function(){
         $rootScope.isLoading=true;
         var data = "action=getLangs";
         $http.post(ajaxUrl,data).success(function(data){
          console.log("list is:",data);
          that.$.langList = data;
          $rootScope.isLoading=false;
         });
     };

     this.$.addNewLang = function(){
    	$rootScope.isLoading = true;
    	if(that.$.lang==""){
    		alert("The value of new lang can not be empty!");
    		return false;
    	}
        var data = "lang="+that.$.lang+"&action=addNewLang";
    	$http.post(ajaxUrl,data).success(function(data){
            if(!data.success){
               /**
               * should add the error message to the head
               **/
               var content = "<div ui-view='error' msg='"+data.message+"'></div>"
               var el = $compile(content)($scope);
               jQuery("#content").prepend(el);
               $rootScope.isLoading=false;
            }else{
               that.getLangs();
            }
            
    	}).error(function(e){
    		console.log(e);
    	});
     };
     
     this.getLangs();
     //console.log("hello");
     //this.getLangs();
	
});
