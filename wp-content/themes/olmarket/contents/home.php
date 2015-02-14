 <div class="pomotion fix-size">
    
        <div class="big-text">WE MAKE WEBSITES .</div>
 
 </div> 


<div class="fix-size">

    <div class="list-item pull-left">
         <div class="item-title"><?php echo $langs["design"]?></div>
         <div class="line"></div>
         <div class="item-description">
           <img src = "<?php bloginfo('template_directory');?>/images/page1-img1.jpg">
           <?php echo $langs["design_content"]?>
         </div>
    </div>

     <div class="list-item pull-left equal-margin">
         <div class="item-title"><?php echo $langs["development"]?></div>
         <div class="line"></div>
         <div class="item-description">
           <img src = "<?php bloginfo('template_directory');?>/images/page1-img2.jpg">
           <?php echo $langs["development_content"]?>
       </div>
     </div>

      <div class="list-item pull-right">
         <div class="item-title"><?php echo $langs["marketing"]?></div>
         <div class="line"></div>
         <div class="item-description">
           <img src = "<?php bloginfo('template_directory');?>/images/page1-img3.jpg">
           <?php echo $langs["marketing_content"]?>
         </div>
    </div>

    <div class="clear"></div>

</div>

<div class="break"></div>
<div class="fix-size">
    
     <div class="list-item pull-left long">
        <div class="item-title">
        	<?php echo $langs["show_case"]?>
            <div class="controll-arrows pull-right"> 
            	<span id="carLeft">&lt;</span>&nbsp;&nbsp;&nbsp;&nbsp;<span id="carRight">&gt;</span> 
            </div>
              
        </div>
        <div class="line"></div>
        <div class="show-case">
          <div class="cases-container">
           
          <?php
            $carousel = getCarousels();
            foreach($carousel["carousels"] as $car):
          ?>
           <div class="case-wraper">
           	   <img src="<?php echo $carousel["baseUrl"]."/screenshort/".$car->pic_name?>" 
               data-carid="<?php echo $car->carousel_id?>"
               data-origin="<?php echo $carousel["baseUrl"]."/original/".$car->pic_name?>"><br>
               <?php echo $car->description;?>
           </div>
         <?php endforeach;?>
        </div>
      </div>
     </div>
     

    <div class="list-item pull-right">
         <div class="item-title"><?php echo $langs["testimonials"]?></div>
         <div class="line"></div>
         <div class="item-description blockquote">
           <div class="quote"></div>
           <div class="testimonials">
              David-Zhu is a developer with a broad skill set and experience, he truly excels in hard work and getting the job done. He is also able to pick up new technologies in a fast paced environment, personally I really enjoyed the time we worked together.
           <div class="pull-right">--eddy</div>
           <div class="clear"></div>

          </div>
        </div>
    </div>
    
     <div class="clear"></div>
</div>

<!-- a container to show loading status and the original image -->
<div class="pic-preview">
    <div class="pic-container">
           <img id="carouselOrigin">
           <div class="loader">
                
           </div>
    </div>

</div>
<!-- end container -->