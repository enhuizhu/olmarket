"use strict";
angular.module("olmarket.carousel").config(['$httpProvider',
function($httpProvider){
 $httpProvider.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded;charset=utf-8";  
}]);