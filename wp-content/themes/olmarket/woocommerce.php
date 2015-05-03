<?php

get_header(); ?>



<div class="woocommerce" style="width:940px;">
 
			<?php
			    if ( have_posts() ) {

                          // the_post();
                           woocommerce_content();
                     
			    }
			?>


</div>

<?php
//get_sidebar();
get_footer();
