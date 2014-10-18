<ul>
    <?php foreach($nav as $k=>$n):?>
        <li>
         <a href="<?php echo site_url($k);?>"<?php acitveClass($k);?>><?php echo $n?></a>
       </li>
    <?php endforeach;?>
    <li>
       <span class="flag uk"></span>
       <span class="flag cn"></span>
    </li>
</ul>