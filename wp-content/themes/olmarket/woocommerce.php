<?php

get_header(); ?>

<div class="break"></div>
<div class="break"></div>
<div class="break"></div>
<div class="break"></div>

<div class="fix-size">
    <div class="list-item pull-left">
         <div class="item-title">
         	 <?php echo $langs["categories"]?>
         </div>
         <div class="line"></div>
         <div class="item-description">
           
           <?php 
             categorySideBar();
           ?>

         </div>
    </div>

    <div class="list-item pull-right long">
    	 <div class="item-title">
    	 	 <?php echo get_the_title()?>
    	 </div>
    	 <div class="line"></div>
    	 <div class="item-description">
              <div class="woocommerce product-wrapper">
 
			<?php
			    if ( have_posts() ) {
                           woocommerce_content();
			    }
			?>
</div>
         


         </div>
    </div>
   
    <div class="clear"></div>
</div>



<?php
//get_sidebar();
get_footer();
?>


<script language="javascript">
  
  var tabs = {
      initTab : function(){
         jQuery(".tabs li").removeClass("active");
  	     jQuery(".tabs li:first-child").addClass("active");

      	 jQuery(".woocommerce-tabs .panel").hide();
      	 jQuery(".woocommerce-tabs #tab-description").show();
      }
  }
  
  jQuery(document).ready(function(){
       tabs.initTab(); 
       /**
       * add event to tab link
       **/
       jQuery(".tabs a").bind("click",function(e){
             e.preventDefault();
             /**
             * get the value of herf
             **/
             var id = jQuery(this).attr("href").substr(1);
             jQuery(".tabs li").removeClass("active");
             jQuery(this).parent().addClass("active");

             jQuery(".woocommerce-tabs .panel").hide();
      	     jQuery(".woocommerce-tabs #"+id).show();
       });
  });	
 
</script>
