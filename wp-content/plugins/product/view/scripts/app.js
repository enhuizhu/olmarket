/**
* entry file of augular js app
**/

var foodMenu = angular.module('foodMenu', ['ngRoute']);

foodMenu.config(['$routeProvider','$httpProvider',function($routeProvider,$httpProvider){
      $httpProvider.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded;charset=utf-8";
      $routeProvider.when("/createCategory",{
      	templateUrl:pluginUrl("/views/createCategory.html"),
      	controller:"AddCategoryController"
      }).when("/",{
        templateUrl:pluginUrl("/views/welcome.html")
      }).when("/listCategory",{
      	templateUrl:pluginUrl("/views/listCategory.html"),
      	controller:"listCategoryController"
      }).when("/addItem",{
         templateUrl:pluginUrl("/views/addItem.html"),
         controller:"addItemController"
      }).when("/listItems",{
         templateUrl:pluginUrl("/views/listItems.html"),
         controller:"listItemsController"
      });
   }]);


