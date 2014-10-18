/** 
* directive for loading
**/
"use strict";
angular.module("olmarket.translation").directive("loading",function(){
	return {
	     restrict:"E",
	     replace:true,
	     templateUrl:viewUrl("directives/htmls/loading.html")
	}
});



