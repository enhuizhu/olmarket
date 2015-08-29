<?php
get_header(); ?>

<div class="break"></div>
<div class="break"></div>
<div class="break"></div>
<div class="break"></div>

<div class="container">
  <div class="col-sm-3 col-md-3 col-lg-3">
    <div class="list-item">
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
  </div>

 <div class="col-sm-9 col-md-9 col-lg-9">
    <div class="list-item">
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
</div>   

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