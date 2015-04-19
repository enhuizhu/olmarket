<div class="break"></div>
<div class="break"></div>
<div class="break"></div>
<div class="break"></div>

<div class="fix-size">
    <div class="list-item pull-left">
         <div class="item-title">
         	 <?php echo ucfirst(strtolower($langs["categories"]))?>
         </div>
         <div class="line"></div>
         <div class="item-description">

            <?php
              
              $displayProducts->categories();

            ?>

         </div>
    </div>
    <div class="list-item pull-right long">
    	<div class="item-title">
    	 	<?php echo $langs["products"]?>
    	 </div>
    	 <div class="line"></div>
    	 <div class="item-description">
         
            <?php
              
              $displayProducts->products();

            ?>

         </div>
      
    </div>
    <div class="clear"></div>     
</div>
