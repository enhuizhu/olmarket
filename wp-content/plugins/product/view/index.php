<div ng-app="foodMenu">
<?php
  include "header.php";
  include "body.php";
?>

<div class="lay" ng-show="isLoading">
      <div class="loading">
            <span>loading..</span>
      </div>
</div>

</div>
<script language="javascript">
   var ajaxUrl = "<?php echo get_site_url()."/wp-admin/admin-ajax.php";?>"
</script>
<!-- Latest compiled and minified JavaScript -->
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.22/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.0rc1/angular-route.min.js"></script>
<script language="javascript">
   function pluginUrl(path){
      return "<?php echo plugins_url("",__FILE__)?>"+path; 
   }
</script>
<!-- include all the angular javascript files -->
<script src="<?php echo plugins_url("scripts/app.js",__FILE__)?>"></script>
<script src="<?php echo plugins_url("scripts/controllers/AddCategoryController.js",__FILE__)?>"></script>
<script src="<?php echo plugins_url("scripts/controllers/listCategoryController.js",__FILE__)?>"></script>
<script src="<?php echo plugins_url("scripts/controllers/addItemController.js",__FILE__)?>"></script>
<script src="<?php echo plugins_url("scripts/controllers/listItemsController.js",__FILE__)?>"></script>
<!-- include all the services -->
<script src="<?php echo plugins_url("scripts/services/apiService.js",__FILE__)?>"></script>