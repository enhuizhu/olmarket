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
<div class="row" ng-app="olmarket.translation" ng-controller="mainCtrl">
 <div class="col-xs-3">
     <menu></menu>
 </div>
 <div class="col-xs-9" id="content">
  <div ng-view>
  </div>
 </div>
<loading ng-show="isLoading"></loading>
</div>

<!--- include all the angular js script -->
<script type="text/javascript" src="<?php echo plugins_url("app/app.js",__FILE__)?>"></script>
<script type="text/javascript" src="<?php echo plugins_url("app/config.js",__FILE__)?>"></script>

<!-- include all the controllers -->
<script type="text/javascript" src="<?php echo plugins_url("app/controllers/mainController.js",__FILE__)?>"></script>
<script type="text/javascript" src="<?php echo plugins_url("app/controllers/addNewLangController.js",__FILE__)?>"></script>
<script type="text/javascript" src="<?php echo plugins_url("app/controllers/langKeyController.js",__FILE__)?>"></script>
<script type="text/javascript" src="<?php echo plugins_url("app/controllers/defaultController.js",__FILE__)?>"></script>

<!-- include all the directives here -->
<script type="text/javascript" src="<?php echo plugins_url("app/directives/menuDirective.js",__FILE__)?>"></script>
<script type="text/javascript" src="<?php echo plugins_url("app/directives/loadingDirective.js",__FILE__)?>"></script>
<script type="text/javascript" src="<?php echo plugins_url("app/directives/uiViewDirective.js",__FILE__)?>"></script>

<!-- include all the services -->
<script type="text/javascript" src="<?php echo plugins_url("app/services/errorHandler.js",__FILE__)?>"></script>
<script type="text/javascript" src="<?php echo plugins_url("app/services/callsApi.js",__FILE__)?>"></script>

