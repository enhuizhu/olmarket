/**
* jQuery carousel extension
* @author Enhui Zhu
**/

jQuery.fn.slideCarousel = function(config){
   
   var config = config || {};
   var container = jQuery(this);
   var defaultSpeed = 500;
   var stayTime = 2000;
   /**
   * should init container's width, accroding to the number
   * of children items
   **/
   var item = container.children("div:first-child");
   var slidNumber = container.children("div").length;
   var itemWidth = item.width();
   var carouselWidth = itemWidth * slidNumber;
   container.width(carouselWidth);
   var speed = config.speed || defaultSpeed;
   var auto = config.auto ||  false;
   var carouselTimeout = null;
   var currentIndex = 0;

   
   /**
   * variable to seve the carousel original image path
   **/
   var carouselUrl = [];


   /**
   * when mouse over the carousel, it should stop automaticly
   **/
   container.mouseenter(function(){
        clearTimeout(carouselTimeout);
   }).mouseleave(function(){
         scrollLeft(true);
   });
   

   /**
   * when user click body, should check if user pic-preview already
   * display
   **/
   jQuery(document).click(function(e){
     if(jQuery(e.target).attr("id")!="carouselOrigin"){
        if(jQuery(e.target).hasClass("glyphicon")){
          if (jQuery(e.target).hasClass("glyphicon-chevron-right")) {
              currentIndex = (currentIndex + 1) % slidNumber;
          };

          if (jQuery(e.target).hasClass("glyphicon-chevron-left")) {
              currentIndex = (currentIndex - 1)% slidNumber;
              if (currentIndex < 0) {
                  currentIndex = slidNumber -1;
              };
          };

          var img = container.find("[data-index="+ currentIndex +"]");
          var imageId = img.attr("data-carid");
          var path = img.attr("data-origin");

          getOriginalPic(imageId, path);

          return false;
        }

        jQuery(".pic-preview").hide();
     }
   });
   
   /**
   * function to load the new image
   **/
   var getOriginalPic = function(imageId, path){
       var winW = jQuery(window).width();
       var winH = jQuery(window).height();
       var winRatio = winW/winH;
       /**
       * add loading class to the image
       **/
       jQuery(".pic-preview").addClass("loading");
       /**
       * remove attr style
       **/
       jQuery(".pic-container").removeAttr("style");
       jQuery(".pic-preview").show();

       carouselUrl[imageId] = new Image();
       carouselUrl[imageId].onload = function(){
          /**
          * should calculate the width of the image and height of the image
          **/
          /**
          * should check if the image need to be scale down
          **/
          if(this.width>=winW || this.height>=winH){
            var ratio = this.width/this.height;
            /**
            * width is very bigger, should scale the width
            **/
            if(ratio>winRatio){
               this.width = winW - 100;
               this.height = this.width / ratio;
            }else{
               this.height = winH - 50;
               this.width = this.height * ratio;
            }
          }

          showPic(imageId);
       }
       carouselUrl[imageId].src = path;
   };

   var showPic = function(imageId){
        /**
        * should show img and hide the loader
        **/
        jQuery(".pic-preview").removeClass("loading");
        jQuery(".pic-preview").show();
        jQuery("#carouselOrigin").attr("src",carouselUrl[imageId].src);
        jQuery("#carouselOrigin").attr("width",carouselUrl[imageId].width);
        jQuery("#carouselOrigin").attr("height",carouselUrl[imageId].height);
        /**
        * reset the position
        **/
        jQuery(".pic-container").css({
           top:"calc(50% - "+carouselUrl[imageId].height/2+"px)",
           left:"calc(50% - "+carouselUrl[imageId].width/2+"px)"
        });
   };


   /**
   * bind click event to the image
   **/
   
   var bindClickEvent = function(){
       container.children("div").unbind("click");
       container.children("div").bind("click",function(e){
        e.stopPropagation();
        /**
        * should get it's id first
        **/
        var carouselId = jQuery(this).children("img").attr("data-carid");
        /**
        * get original image path
        **/
        var originalImage = jQuery(this).children("img").attr("data-origin");
        currentIndex = jQuery(this).children("img").attr("data-index");
        
        if(carouselUrl["pic"+carouselId]==undefined){
           getOriginalPic("pic"+carouselId,originalImage);
        }else{
           showPic("pic"+carouselId);  
        }
       }); 
   }


   var scrollLeft= function(inside){
   	   jQuery(container.children("div")).each(function(index){
             jQuery(this).animate({left:-itemWidth+"px"},speed);
   	   });
       
   	    /**
         * should remove the first child first
         * and then insert it into the container again
         **/

        jQuery(container.children("div")).promise().done(function(){
              container.children("div").removeAttr("style");
              var firstElement  = container.children("div").get(0);
              jQuery(firstElement).remove();
              container.append(firstElement);
              bindClickEvent();
        });
        
        if(auto && inside){
        	carouselTimeout=setTimeout(function(){
                scrollLeft(inside);
        	},speed+stayTime);
        }              
   	}

   	var scrollRight = function(){
          /**
          * should remove the last element, and prepend to the container
          * after everything is done move all the element right
          **/
          var lastElement = container.children("div:last-child").get(0);
          jQuery(lastElement).remove();
          container.prepend(lastElement);
          
          bindClickEvent();

          jQuery(container.children("div")).each(function(){
          	jQuery(this).css({left:-itemWidth+"px"});
          });

          /**
          * should do the animation that move all the element right
          **/ 
          jQuery(container.children("div")).each(function(){
          	jQuery(this).animate({
          		left:"0px"
          	},speed);
          }); 

          jQuery(container.children("div")).promise().done(function(){
             container.children("div").removeAttr("style");     	
          });
     }


   
   if(!!config.left){
   	  config.left.bind("click",function(){
   	  	scrollLeft();
   	  });
   }

   if(!!config.right){
   	   config.right.bind("click",function(){
   	   	 scrollRight();
   	   	});
   }

   if(auto){
       scrollLeft(true);
   }

   bindClickEvent();

   return {
      /**
      * function to make carousel scroll left
      **/
   	  scrollLeft: scrollLeft,
     
     /**
     * function to make carousel scroll right
     **/
     scrollRight: scrollRight
   }
}