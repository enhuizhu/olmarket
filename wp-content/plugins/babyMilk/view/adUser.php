<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo plugins_url("css/style.css", __FILE__)?>"/>
<script language="javascript">
<!--
   var adminAjax="<?php echo site_url("wp-admin/admin-ajax.php")?>";
-->
</script>
<script language="javascript" src="<?php echo plugins_url("js/userManagement.class.js", __FILE__)?>"></script>
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
      <label>User Name:</label><br>
      <input type="text" name="userName">
   </div>
   
   <div class="form-group">
      <label>Address:</label><br>
      <textarea name="homeAddress"></textarea>
   </div>   
   
    <div class="form-group">
      <label>Email:</label><br>
      <input type="text" name="email">
   </div>
   
    <div class="form-group">
      <label>Phone Number:</label><br>
      <input type="text" name="phoneNumber">
   </div>
   
   <div class="form-group">
      <input type="submit" value="Add New User" class="btn btn-primary">
  	  <input type="hidden" name="addUser" value="1">
   </div>
   
</form>


<?php
  /**
  *  should check if there are some users in database, if so should
  *  output all of them
  **/
  if(isset($users) && !empty($users)):
  ?>
  <table class="table table-striped table-bordered">
  <tr>
     <th>User Id</th>
     <th>User Name</th>
     <th>Homne Address</th>
     <th>Email</th>
     <th>Phone Number</th>
     <th>Delete</th>
     <th>Edit</th>
  </tr>
 
   <?php	 
	 foreach($users as $user):
            //var_dump($user);
   ?>
   <tr data-userId="<?php echo $user->userId?>">
      <td><?php echo $user->userId?></td>
      <td class="edit userName" contenteditable="false"><?php echo $user->userName?></td>
      <td class="edit homeAddress" contenteditable="false"><?php echo $user->homeAddress?></td>
      <td class="edit email" contenteditable="false"><?php echo $user->email?></td>
      <td class="edit phoneNumber" contenteditable="false"><?php echo $user->phoneNumber?></td>
	  <td><button data-deleteId="<?php echo $user->userId?>" class="btn btn-danger">Delete</button></td>
	  <td><button data-editId="<?php echo $user->userId?>" class="btn btn-info">Edit</button></td>
   </tr>
<?php
   endforeach;
 ?>
  </table>
 <?php 
  endif;
 ?>  



