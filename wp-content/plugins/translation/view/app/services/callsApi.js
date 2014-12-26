/**
* All the functions that related to ajax request will 
* be here
**/
"use strict";

angular.module("olmarket.translation")
.service("callsApi",function($http){
	
   this.getLangs = function(){
   	   var data = "action=getLangs";
       return $http.post(ajaxUrl,data);
   };

   /**
   *  function to create new lang key
   **/
   this.createLangKey = function(postData){
   	   var data="action=createLang";
   	   data=data+"&"+postData;
   	   return $http.post(ajaxUrl,data);
   };

   /**
   * function get all the lang key base on lang id
   **/
   this.getAllLangKeys = function(langId){
        var data = "action=getLangKeys";
        data+="&langId="+langId;
        return $http.post(ajaxUrl,data);   
   };

   /**
   * function to delete lang key
   **/
   this.deleteLangKey = function(langKeyId,langId){
       var data = "action=deleteLangKey";
       data+="&langKeyId="+langKeyId;
       data+="&langId="+langId;
       return $http.post(ajaxUrl,data);
   };


   /**
   * function to update the value of lang base on value id
   **/
   this.updateLangKeyVal = function(key){
       var data = "action=updateLangKeyVal";
       data+="&valId="+key.val_id;
       data+="&value="+key.lang_value;
       data+="&keyId="+key.key_id;
       data+="&langId="+key.langId;
       return $http.post(ajaxUrl,data);
   };

});
