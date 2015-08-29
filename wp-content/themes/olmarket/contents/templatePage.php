<?php
  /**
  * template for the page
  **/
?>
<div class="break"></div>
<div class="break"></div>
<div class="break"></div>
<div class="break"></div>

<div class="container">
    <div>
         <div class="item-title">
         	 <?php  
             echo isset($pageName)?$pageName:"undefined"
           ?>
         </div>
         <div class="line"></div>
         <div class="item-description">
           <?php
              switch ($pageName) {
                case '404':
                  echo "<div class='theme-404'>".$langs["404"]."</div>";
                  break;
                
                default:
                   echo "oh , i don't know which page you request.";
                  break;
              }

            ?>
         </div>
    </div>
</div>