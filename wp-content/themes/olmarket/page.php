<?php

//die("page php!");
get_header(); ?>



<div class="products-wrapper">
 
			<?php
				// Start the Loop.
				
              if(have_posts()){
				 while ( have_posts() ){
                      the_post();
                      the_content(__('(more...)'));
				 } 
			  }
			?>


</div>

<?php
//get_sidebar();
get_footer();
