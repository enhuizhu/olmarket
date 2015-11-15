<?php
 /**
 * This is regular php template file
 **/
?>

<div class="container">
    
    <div class="col-sm-3 col-md-3 col-lg-3">

    <div class="list-item">
         <div class="item-title">
         	 <?php echo $langs["feature"]?>
         </div>
         <div class="line"></div>
         <div class="item-description">

           <?php get_sidebar(); ?>
         </div>
    </div>
  
  </div>
  
  <div class="col-sm-9 col-md-9 col-lg-9">

    <div class="list-item pull-right">
    	 <div class="item-title">
    	 	<?php echo $langs["blog"]?>
    	 </div>
    	 <div class="line"></div>
    	 <div class="item-description">
    	 	
        <?php 
        $post_id = get_the_ID();

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1  ;
        $perPageRange = 5;

        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' => $perPageRange,
            'paged' => $paged,
            'page' => $paged
          );

        if (!is_home() && !is_category()) {
           $query_args["p"] = $post_id;
        }

        $the_query = new WP_Query( $query_args ); 

        ?>


        <?php if ($the_query->have_posts()) : while ($the_query->have_posts()) : $the_query->the_post(); ?>
            <div class="blog-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></div>
            <div class="blog-post-date">Posted on <?php the_time('F jS, Y') ?></div>
            <div class="blog-content">
                                   

                <?php 
                    $content = get_the_content(__('(more...)')); 
                    
                    if (is_home() || is_category()) {
                        echo brifContent($content);
                    }else{
                        the_content(_('(more...)'));
                    }
                    
                ?>
          

            </div>
             

            <?php endwhile; ?>
            
            <?php wp_reset_postdata(); ?>            

            <?php if(!is_home() && !is_category()):?>
            
            <div class="navigation">
              <span class="pull-left"><?php previous_post_link('%link') ?></span> 
              <span class="pull-right"><?php next_post_link(' %link') ?></span>
              </div class="clear"></div>
            </div>
            
            <?php else:
              
              if (function_exists(custom_pagination)) {
                custom_pagination($the_query->max_num_pages,$perPageRange,$paged);
              }
              endif;
            ?>

           <?php else: ?>
            <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
          <?php endif; ?>

    </div>
    
    </div>

</div>
   
</div>
