"use strict";
angular.module("olmarket.translation")
.controller("langKeysCtrl",function($scope,$routeParams,$rootScope,errorHandler,callsApi){
	//$scope.langId=$routeParams.langId;
    var that=this;
    this.$=$scope;
    this.langId=$routeParams.langId;

    /**
    * function to get all the lang keys base 
    * on lang key id
    **/
    this.getAllLangKey = function(){
        $rootScope.isLoading = true;
        callsApi.getAllLangKeys(this.langId)
        .then(function(data,status){
             console.log(data.data);
             that.$.langKeys = data.data;
             $rootScope.isLoading = false;
        });
    }; 

    this.$.createNewLangKey=function(){        
        var data="langId="+that.langId;
        data+="&langKey="+that.$.form.langKey;
        data+="&langVal="+that.$.form.langVal;
        $rootScope.isLoading = true;
        callsApi.createLangKey(data).then(function(data,status){
           $rootScope.isLoading = false;
           console.log(data.data);
           var resp = data.data;
           if(resp.success){
              that.$.langKeys = resp.langs;
           }else{
           	  errorHandler.generateError(resp.message,that.$);
           }

        },function(error,status){
        	errorHandler.generateError("error happen, error code from server is:"+status);
        });
    };

    this.$.deleteLangKeyBaseOnKey=function(keyId,langId){
        console.log("the key id is:",keyId);
        $rootScope.isLoading=true;
        callsApi.deleteLangKey(keyId,langId).then(function(data,status){
           console.log(data.data);
           that.$.langKeys = data.data;
           $rootScope.isLoading=false;
        });
    };

    this.$.updateLangVal=function(key){
         $rootScope.isLoading = true;
         key.langId=that.langId;
         callsApi.updateLangKeyVal(key).then(function(data,status){
             console.log(data.data);
             var resp = data.data;
             $rootScope.isLoading = false;
             if(!resp.success){
                 errorHandler.generateError(resp.message,that.$);
             }
         });
    };

    this.getAllLangKey();
});