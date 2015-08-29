    <?php foreach($nav as $k=>$n):?>
        <li>
         <a href="<?php echo site_url($k);?>"<?php acitveClass($k);?>><?php echo $n?></a>
       </li>
    <?php endforeach;?>
    <li>
       <span onclick ='location.href="<?php echo site_url("?lang_select=en")?>"' class="flag uk"></span>
       <span onclick='location.href="<?php echo site_url("?lang_select=en")?>"' class="flag cn"></span>
    </li>
    
