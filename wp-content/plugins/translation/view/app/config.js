"use strict"
angular.module("olmarket.translation").config(['$routeProvider','$httpProvider',
function($routeProvider,$httpProvider){
$httpProvider.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded;charset=utf-8";
   $routeProvider.
    when("/addNewLang",{
        templateUrl:viewUrl("views/addNewLang.html"),
        controller:"addNewLangCtrl"	
    }).when("/langKeyManageMent/:langId",{
    	templateUrl:viewUrl("views/langKeysManagement.html"),
    	controller:"langKeysCtrl"
    }).otherwise({
    	templateUrl:viewUrl("views/default.html"),
    	controller:"defaultCtrl"
    });
}]);