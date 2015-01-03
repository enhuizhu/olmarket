"use strict";

angular.module("olmarket.carousel").controller("mainCtrl",function($scope,$http){
	
  $scope.uploading=false;
  $scope.uploadUrl = uploadUrl;
	
  console.log("uploadUrl is:",$scope.uploadUrl);

	$scope.createNewImg = function(){
       //console.log("create new image!");
       var img = document.getElementById("imageToUpload").files[0];
       console.log("image is:",img);
       if(!img){
       	   alert("pleae select an image to upload!");
       	   return false;
       }

       var type = img.type;
       if(type.indexOf("image")==-1){
       	   alert("file must be image");
       	   return false;
       }

       var description = document.getElementById("description");
       if(jQuery.trim(description.value)==""){
       	   alert("pleae input description of the image");
       	   return false;
       }
       
       $scope.uploading=true;

       var formData = new FormData();
       formData.append("carouselImg",img);
       formData.append("description",description.value);
       formData.append("action","addNewImage");

       var request = new XMLHttpRequest();
        
       request.onreadystatechange = function () {
       	  if(request.readyState==4){
              $scope.$apply(function(){
                 $scope.uploading=false;
              });
              if (request.status==200) {
                  console.log(request.responseText);
                  var resp = JSON.parse(request.responseText);
                  if(resp.success){
                  	 alert("upload successfully!");
                     $scope.$apply(function(){
                        $scope.carouselData=resp.carouselData; 
                     }); 
                  }else{
                  	 alert(resp.message);
                  }
              }else{
              	  alert("error:"+request.status);
              }
       	  }
       }

        //event listener progress
	    request.upload.addEventListener('progress',function(event){
	        if(event.lengthComputable){
	            //get our percentage
	            var percent = (Math.round(event.loaded / event.total) * 100) +"%";
	            console.log("percent",percent);
	            jQuery("#progress-bar").html(percent).css("width",percent);
	        }
	    });
	    
	    //add event for when the progress is done
	    request.upload.addEventListener('load',function(event){
	         console.log("upload completed!");
	    });
	     //for errors we'll use the info element but for now console log it
	    request.upload.addEventListener('error',function(event){
	        console.log(event);
	    });

       request.open("POST",ajaxUrl);
        //set the request header for no caching
       request.setRequestHeader("Cache-Control","no-cache");
       request.send(formData);
	};
    

    /**
    * function to get all the carousel data
    **/
    this.getCarouselData = function(){
       var data="action=getCarouselData";
       $http.post(ajaxUrl,data).then(function(data,status){
              $scope.carouselData = data.data;
              console.log("carousel data is:",data.data);
       });
    };

    /**
    * function to update carousel
    **/
    $scope.update=function (carousel) {
       var data="action=updateCarousel";
       data+="&carouselId="+carousel.carousel_id;
       data+="&description="+carousel.description;
       console.log("data",data);
       $http.post(ajaxUrl,data).then(function(data,status) {
          var resp = data.data;
          console.log("response is:",resp);
       });

       console.log("the carousel is going to update",carousel);
    }

    /**
    * function to delete carousel
    **/
    $scope.delete= function(carousel){
       var data="action=deleteCarousel";
       data+="&carouselId="+carousel.carousel_id;
       $http.post(ajaxUrl,data).then(function(data,status){
           console.log(data.data);
       });
       for(var i=0;i<$scope.carouselData.length;i++){
          if ($scope.carouselData[i].carousel_id==carousel.carousel_id) {
              $scope.carouselData.splice(i,1); 
              break;
          };
       }
    }


   
    this.getCarouselData();
});