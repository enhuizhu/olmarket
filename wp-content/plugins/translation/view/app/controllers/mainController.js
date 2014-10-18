"use strict"
angular.module("olmarket.translation").controller("mainCtrl",
 function($scope,$rootScope){
   $rootScope.isLoading = false;
   $rootScope.isError = true;
   $scope.message ="hello";
});