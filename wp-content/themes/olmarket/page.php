<?php

get_header(); ?>

<div class="break"></div>
<div class="break"></div>
<div class="break"></div>
<div class="break"></div>

<div class="fix-size">
    <div class="list-item pull-left">
         <div class="item-title">
         	 <?php echo $langs["contact_info"]?>
         </div>
         <div class="line"></div>
         <div class="item-description">
                    
                    side bar here
            
         </div>
    </div>

    <div class="list-item pull-right long">
    	 <div class="item-title">
    	 	<?php echo $langs["contact_form"]?>
    	 </div>
    	 <div class="line"></div>
    	 <div class="item-description">
              <div class="woocommerce product-wrapper">
 
			<?php
			    if(have_posts()){
				 while ( have_posts() ){
                      the_post();
                      the_content(__('(more...)'));
				 } 
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