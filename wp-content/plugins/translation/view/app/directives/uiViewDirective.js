"use strict";
angular.module("olmarket.translation").directive("uiView",function(){
     return {
     	replace:true,
     	scope:{},
        link:function(scope,element,attr){
        	if(attr.msg!=undefined){
                scope.errorMsg=attr.msg;
        	}
        },
     	templateUrl:function(element,attr){
            var uiView=attr.uiView;
            return viewUrl("directives/htmls/"+uiView+".html");
     	}
     }
});