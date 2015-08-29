<div class="container">
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
         <div class="list-item">
           <div class="item-title"><?php echo $langs["design"]?></div>
           <div class="line"></div>
           <div class="item-description">
             <img src = "<?php bloginfo('template_directory');?>/images/page1-img1.jpg">
             <?php echo $langs["design_content"]?>
           </div>
         </div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
     <div class="list-item">
         <div class="item-title"><?php echo $langs["development"]?></div>
         <div class="line"></div>
         <div class="item-description">
           <img src = "<?php bloginfo('template_directory');?>/images/page1-img2.jpg">
           <?php echo $langs["development_content"]?>
       </div>
     </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
      <div class="list-item">
         <div class="item-title"><?php echo $langs["marketing"]?></div>
         <div class="line"></div>
         <div class="item-description">
           <img src = "<?php bloginfo('template_directory');?>/images/page1-img3.jpg">
           <?php echo $langs["marketing_content"]?>
         </div>
      </div>
    </div>

  </div>
    

</div>

<div class="break"></div>
<div class="container">
    <div class="col-md-8 col-sm-8 col-lg-8">
     <div class="list-item">
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
            foreach($carousel["carousels"] as $k => $car):
          ?>
           <div class="case-wraper">
           	   <img src="<?php echo $carousel["baseUrl"]."/screenshort/".$car->pic_name?>" 
               data-carid="<?php echo $car->carousel_id?>"
               data-origin="<?php echo $carousel["baseUrl"]."/original/".$car->pic_name?>"
               data-index="<?php echo $k;?>"
               ><br>
               <?php echo $car->description;?>
           </div>
         <?php endforeach;?>
        </div>
      </div>
     </div>
    </div> 
    
    <div class="col-sm-4 col-md-4 col-lg-4">
     <div class="list-item">
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

   </div>
    
</div>

<!-- a container to show loading status and the original image -->
<div class="pic-preview">
    <div class="pic-container">
           <div class="close-btn"><span>&times;</span></div>
           <img id="carouselOrigin">
           <div class="loader">
                
           </div>
    </div>

    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="glyphicon glyphicon-chevron-right"></span>
</div>
<!-- end container -->