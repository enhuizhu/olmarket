<?php
   /**
   * template for contact us page
   **/
?>

<?php
 /**
 * This is regular php template file
 **/
?>

<div class="break"></div>
<div class="break"></div>
<div class="break"></div>
<div class="break"></div>

<div class="fix-size">
    <div class="list-item pull-left">
         <div class="item-title">
         	 <?php echo $langs["contact_info"]?>
         </div>
         <div class="line"></div>
         <div class="item-description">
    
            <div class="list-wrapper">
               <span class="pull-left">E-mail:</span>
               <span class="pull-left">zhuen2000@163.com</span>
               <div class="clear"></div>
            </div>
            
            <div class="list-wrapper">
               <span class="pull-left">Skype:</span>
               <span class="pull-left">david-china-express</span>
               <div class="clear"></div>
            </div>

            <div class="list-wrapper">
               <span class="pull-left">QQ:</span>
               <span class="pull-left">474452556</span>
               <div class="clear"></div>
            </div>

         </div>
    </div>

    <div class="list-item pull-right long">
    	 <div class="item-title">
    	 	<?php echo $langs["contact_form"]?>
    	 </div>
    	 <div class="line"></div>
    	 <div class="item-description">
        <div class="list-wrapper long">   	 	
             <?php 
               if(isset($contact_error)){
                   echo "<span class='error'>$contact_error</span>";
               }
               
               if(isset($success)){
                   echo "<span class='success'>$success</span>";
               }
             ?>
        </div>
        <form action="" method="post">
            <div class="list-wrapper long">
               <span class="pull-left">
                 <?php echo $langs["your_email"]?>:
               </span>
               <span class="pull-left">
                    <input type="text" name="email" value="<?php echo $_POST["email"]?>">
               </span>
               <div class="clear"></div>
            </div>
 
            <div class="list-wrapper long">
               <span class="pull-left">
                 <?php echo $langs["your_name"]?>:
               </span>
               <span class="pull-left">
                    <input type="text" name="username" value="<?php echo $_POST["username"]?>">
               </span>
               <div class="clear"></div>
            </div>

            <div class="list-wrapper long">
               <span class="pull-left">
                <?php echo $langs["your_comment"]?>:
               </span>
               <span class="pull-left">
                    <textarea name="usercomment"><?php echo $_POST["usercomment"]?>
                    </textarea>
               </span>
               <div class="clear"></div>
            </div>
 
            <div class="list-wrapper long">
                <input type="submit" value="<?php echo $langs["send"]?>">
            </div>
            </form>             
    	 </div>
    </div>
   
    <div class="clear"></div>
</div>
