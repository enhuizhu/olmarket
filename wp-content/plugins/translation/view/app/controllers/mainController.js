"use strict"
angular.module("olmarket.translation").controller("mainCtrl",
 function($scope,$rootScope,callsApi){
   $rootScope.isLoading = false;
   $rootScope.isError = true;
   $rootScope.langList=[];
   $rootScope.getLangs = function(){
   	  $rootScope.isLoading=true;
         callsApi.getLangs().then(function(data){
             console.log("list is:",data);
             $rootScope.langList = data.data;
             $rootScope.isLoading=false;
         });
   }
   $rootScope.getLangs();

});