<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<!-- include customize css -->
<link rel="stylesheet" href="<?php echo plugins_url("style.css",__FILE__)?>"
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-route.js"></script>
<script type="text/javascript">
  /**
  * the url which will be used to comunicate with backend
  **/
  var ajaxUrl = "<?php echo get_site_url()."/wp-admin/admin-ajax.php";?>"
  
  /**
  * the url for the image which has been uploaded
  **/
  var uploadUrl = "<?php echo plugins_url("carousel/uploads")?>";
  /**
  * wrap php plugins_url funciton into javascript, it will be used 
  * in angular directive
  **/
  function viewUrl(path){
     var basicUrl = "<?php echo plugins_url("app/",__FILE__)?>";
     return basicUrl+path;
  }
</script>

<!--- use bootstrap class to seperate the whole page into two columns-->
<p>&nbsp;</p>

<div class="container-fluid" ng-app="olmarket.carousel" ng-controller="mainCtrl">
    <form enctype="multipart/form-data" ng-submit="createNewImg()">
    <div class="row">
       <div class="col-sm-3">
             select image:
       </div>
       <div class="col-sm-5">
            <input type="file" name="imageToUpload" id="imageToUpload">
       </div>
    </div>
    <p>&nbsp;</p>
    <div class="row">
       <div class="col-sm-3">
             Description:
       </div>
       <div class="col-sm-5">
             <textarea name="description" id="description"></textarea>
       </div>
    </div>
    <p>&nbsp;</p>
    <div class="row">
        <div class="col-sm-12">
        	 <input type="submit" value="upload" class="btn btn-primary"/>
        </div>
    </div>
    </form>
   <p>&nbsp;</p>
   <table class="table table-striped">
   	    <thead>
   	    	<tr>
   	    		<th>Id</th>
   	    		<th>Carousel Image</th>
   	    		<th>Carousel Description</th>
   	    		<th>Delete</th>
   	    		<th>Update</th>
   	        </tr>
   	    </thead>
   	    <tbody>
   	    	<tr ng-repeat="carousel in carouselData">
   	    		<td>{{carousel.carousel_id}}</td>
   	    		<td><img ng-src="{{uploadUrl+'/screenshort/'+carousel.pic_name}}" width="50"></td>
   	    		<td><textarea ng-model="carousel.description"></textarea></td>
   	    		<td>
   	    		 <button class="btn btn-danger" ng-click="delete(carousel)">
   	    		    <span class="glyphicon glyphicon-remove"></span>
   	    		    Delete
   	    		 </button>
   	    	   </td>
   	    		<td>
              <button class="btn btn-primary" ng-click="update(carousel)">
   	    		    <span class="glyphicon glyphicon-refresh"></span>
   	    		    Update
   	    		 </button>
   	    		</td>
   	    	</tr>
   	    </tbody>
   </table>
    <div class="lay" ng-show="uploading">
         <div class="pop-up">
               <div class="progress">
				  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 0%;" id="progress-bar">
				    0%
				  </div>
				</div>
         </div> 
    </div>
</div>	

<!--- include all the angular js script -->
<script type="text/javascript" src="<?php echo plugins_url("app/app.js",__FILE__)?>"></script>
<script type="text/javascript" src="<?php echo plugins_url("app/config.js",__FILE__)?>"></script>

<!-- include all the controllers -->
<script type="text/javascript" src="<?php echo plugins_url("app/controllers/mainController.js",__FILE__)?>"></script>

