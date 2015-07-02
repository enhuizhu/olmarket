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

<script type="text/javascript">

   jQuery(document).ready(function(){
       
       jQuery(".showlogin").attr("href","<?php echo site_url("my-account")?>");
  
   });


</script>




<?php
//get_sidebar();
get_footer();
?>