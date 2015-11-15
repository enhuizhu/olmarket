<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<?php
  /**
  * baby milk inter face is here
  **/
  ?>
  <style type="text/css">
    .mrow{margin-bottom:10px;}
	.error{color:rgb(94, 7, 7);margin-bottom:10px;}
	.content{margin-top:44px;}
	.ems td,.ems th{font-weight:bold;}
	.parcelNumber{padding-bottom:10px;}
    .username{float:right;}
  </style>
  
  <?php if(isset($error) && !empty($error)):?>
    <div class="error"> 
	   <?php echo $error;?>
	</div>
  <?php endif;?>
  
  
  <form action="" method="post">
     <div class="mrow">
	    <label>请输入您的快递单号：</label>
		<input type="text" name="parcelNumber">
		<div class="clear"></div>
	 </div>
	 <div class="mrow">
	    <input type="submit" value="开始查询">
	 </div>
  </form>
  
  
<?php if(isset($result)):?>  
  <div class="content">
     <div class="parcelNumber">
	   <?php echo $parcelNumber?>
	   <?php if(isset($userName) && !empty($userName)):?>
	      <span class="username">
		     您好，<?php echo $userName?> ！
		  </span>
	     <?php endif;?>
	 </div>
	 
	 <?php echo $result;?>
  </div>
<?php endif;?>
  
  
  
  
  
  <p>&nbsp;</p>
  
  
  