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

   /**
   * when mouse over the carousel, it should stop automaticly
   **/
   container.mouseenter(function(){
        clearTimeout(carouselTimeout);
   }).mouseleave(function(){
         console.log("mouse leave")
         scrollLeft(true);
   });

   
   /**
   * bind click event to the image
   **/
   
   console.log("the div inside container is:",container.children("div"));
   
   var bindClickEvent = function(){
       container.children("div").unbind("click");
       container.children("div").bind("click",function(){
        console.log("div clicked!");
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