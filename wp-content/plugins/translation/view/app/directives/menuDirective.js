"use strict"

angular.module("olmarket.translation").directive("menu",function(){
	return {
	   restrict:"E",
	   replace: true,
	   templateUrl:viewUrl("directives/htmls/sideMenus.html")
	}
});


