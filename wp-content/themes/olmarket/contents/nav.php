<ul>
    <?php foreach($nav as $k=>$n):?>
        <li>
         <a href="<?php echo site_url($k);?>"<?php acitveClass($k);?>><?php echo $n?></a>
       </li>
    <?php endforeach;?>
    <li>

       <a href="<?php echo site_url("?lang_select=en")?>" class="flag uk"></a>
       <a href="<?php echo site_url("?lang_select=cn")?>" class="flag cn"></a>
    </li>
</ul>