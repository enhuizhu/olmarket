<div class="break"></div>
<div class="break"></div>
<div class="break"></div>
<div class="break"></div>

<div class="container">
    
   <div class="col-sm-3 col-md-3 col-lg-3">
    <div class="list-item">
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
  </div>
  
  <div class="col-sm-9 col-md-9 col-lg-9">
    <div class="list-item">
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
 </div>

</div>
