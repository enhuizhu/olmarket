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
		  $taxonomy     = 'product_cat';
		  $orderby      = 'name';  
		  $show_count   = 0;      // 1 for yes, 0 for no
		  $pad_counts   = 0;      // 1 for yes, 0 for no
		  $hierarchical = 1;      // 1 for yes, 0 for no  
		  $title        = '';  
		  $empty        = 0;
		$args = array(
		  'taxonomy'     => $taxonomy,
		  'orderby'      => $orderby,
		  'show_count'   => $show_count,
		  'pad_counts'   => $pad_counts,
		  'hierarchical' => $hierarchical,
		  'title_li'     => $title,
		  'hide_empty'   => $empty
		);
		?>
		<?php 
		$all_categories = get_categories( $args );
		//print_r($all_categories);
		foreach ($all_categories as $cat) {
		    //print_r($cat);
		    if($cat->category_parent == 0) {
		        $category_id = $cat->term_id;

		?>      

		<?php       

		        echo '<br /><a href="'. get_term_link($cat->slug, 'product_cat') .'">'. $cat->name .'</a>'; ?>


		        <?php
		        $args2 = array(
		          'taxonomy'     => $taxonomy,
		          'child_of'     => 0,
		          'parent'       => $category_id,
		          'orderby'      => $orderby,
		          'show_count'   => $show_count,
		          'pad_counts'   => $pad_counts,
		          'hierarchical' => $hierarchical,
		          'title_li'     => $title,
		          'hide_empty'   => $empty
		        );
		        $sub_cats = get_categories( $args2 );
		        if($sub_cats) {
		            foreach($sub_cats as $sub_category) {
		                echo  $sub_category->name ;
		            }

		        } ?>



		    <?php }     
		}
		?>
            
         </div>
    </div>

    <div class="list-item pull-right long">
    	 <div class="item-title">
    	 	<?php echo $langs["product_list"]?>
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