"use strict";
angular.module("olmarket.translation").service("errorHandler",function($compile){
    
     //generate the error
     this.generateError = function(message,scope){
     	 /**
         * should add the error message to the head
         **/
         var content = "<div ui-view='error' msg='"+message+"'></div>"
         var el = $compile(content)(scope);
         jQuery("#content").prepend(el);
     }
});