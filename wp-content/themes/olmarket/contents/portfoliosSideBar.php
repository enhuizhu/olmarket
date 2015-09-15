    <div class="list-item">
         <div class="item-title">
           <span class="glyphicon glyphicon-list">
                
           </span>
         </div>
         <div class="line"></div>
         <div class="item-description">
              
          <?php 
              $portfolios = getPortfolioSideBar();
              
              foreach ($portfolios as $category => $values) :
          ?>              
              <ul class="ui-tree">
                <li>
                  <span class="operator"></span> <?php echo $category; ?>
                  <ul>
                     <?php foreach ($values as $value):?>
                     <li>
                         <a href="<?php echo $value["link"]?>"> 
                          <?php echo $value["title"]?>
                         </a>
                     </li>
                     <?php endforeach;?>
                  </ul>
                <li>
              </ul>   
          <?php
              endforeach;
          ?>

         </div>
    </div>
