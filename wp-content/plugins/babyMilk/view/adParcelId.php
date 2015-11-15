<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo plugins_url("css/style.css", __FILE__)?>"/>
<?php
 /**
 * check if there is any error, if the error is not empty, should output all the errors.
 **/
 if(isset($errors) && !empty($errors)){
     foreach($errors as $error){
	    echo "<div class='error'>$error</div>";
	 }
 }
 
 
 /**
 * check if user has been added to the database successfully, 
 * should output the success message
 **/
 if(isset($success) && !empty($success)){
    echo "<div class='success'>$success</div>";
 }
 
?>
<form action="" method="post">
   <div class="form-group">
      <label>User Name</label><br>
	  <select name="UserId">
	     <option value="0">Please select a user</option>
		 <?php foreach($users as $user):?>
		  <option value="<?php echo $user->userId?>"><?php echo $user->userName?> </option>
		 <?php endforeach;?>
	   </select>
      <div class="clear"></div>
   </div>
   
   <div class="form-group">
      <label>Parcel Id</label><br>
      <input type="text" name="parcelId">
      <div class="clear"></div>
   </div>

    <div class="form-group">
      <label>Price</label><br>
      <input type="number" name="price">
      <div class="clear"></div>
   </div>

   <div class="form-group">
      <label>Cost</label><br>
      <input type="number" name="cost">
      <div class="clear"></div>
   </div>


    <div class="form-group">
      <label>date</label><br>
      <input type="date" name="p_date">
      <div class="clear"></div>
   </div>

   <div class="form-group">
      <label>note</label><br>
      <textarea name="note"></textarea>
      <div class="clear"></div>
   </div>


   <div class="form-group">
       <input type="hidden" value="1" name="parcelForm">
	   <input type="submit" value="Add Parcel Id" class="btn btn-primary">
   </div>
</form>


<?php
  /**
  *  should check if there are some users in database, if so should
  *  output all of them
  **/
  if(isset($parcels) && !empty($parcels)):
   
  $total = 0;
  $totalCost = 0;
  $totalProfit = 0;

  ?>
  <p>&nbsp;</p>
  <table class="table table-striped table-bordered">
  <tr>
     <th>Parcel Id</th>
     <th>User Name</th>
     <th>Date</th>
     <th>price</th>
     <th>cost</th>
     <th>profit</th>
     <th>note</th>
     <th>Update</th>
     <th>Delete</th>
  </tr>
 
   <?php	 
	 foreach($parcels as $parcel):
            //var_dump($user);
?>
   <tr>
      <td><?php echo $parcel->parcelId?></td>
      <td><?php echo $parcel->userName?></td>
      <td contenteditable="true" data-date="<?php echo $parcel->p_date?>"> 
        <?php echo $parcel->p_date?>
      </td>
      <td>
      &yen;
      <span data-price="<?php echo $parcel->price?>" contenteditable="true">
        <?php 
           $total += $parcel->price;
           echo $parcel->price
        ?>
      </span>
      </td>
      <td>
      &yen;
      <span data-cost="<?php echo $parcel->cost?>" contenteditable="true">
      <?php
         $totalCost += $parcel->cost;
         echo $parcel->cost;
      ?>
      </span>
      </td>
      <td>
      &yen;
      <?php
         $totalProfit += ($parcel->price - $parcel->cost);
         echo $parcel->price - $parcel->cost;
      ?>
      </td>
      <td contenteditable="true" data-note=""><?php echo $parcel->note?></td>
      <td><button class="btn btn-primary" data-parcelId="<?php echo $parcel->parcelId?>">update</button></td>
      <td>
	    <form action="" method="post">
		   <input type="hidden" value="<?php echo $parcel->parcelId?>" name="deleteId">
		   <input type="submit" value="delete" class="btn btn-danger">
	    </form>
	</td>
   </tr>
<?php
   endforeach;
 ?>
 <tr>
    <td>Total:</td>
    <td></td>
    <td></td>
    <td>
    &yen;
    <?php
      echo $total;
    ?>
    </td>
    <td>
    &yen;
    <?php
      echo $totalCost;
    ?>
    </td>
    <td>
    &yen;
    <?php
      echo $totalProfit;
    ?>
    </td>


    <td></td>
    <td></td>
 </tr>
  </table>
 
  
 <?php 
  endif;
 ?>  
<script language="javascript">
<!--
   var adminAjax="<?php echo site_url("wp-admin/admin-ajax.php")?>";
-->
</script>
<script language="javascript" src="<?php echo plugins_url("js/parcelManagement.class.js", __FILE__)?>"></script>

