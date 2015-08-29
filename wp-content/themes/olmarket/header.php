<!doctype html>
<html>
<head>
   <title>Online Marketing Solution</title>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

   <!-- Optional theme -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
   <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory')?>/style.css">
   <?php
      wp_head();
   ?>
</head>
<body>
  
  <div class="head-wrapper">
     <div class="container"> 
      <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#"> 
              <div class="logo-wrapper">
                   Online Marketing Solution
              </div>
          </a>
      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           <ul class="nav navbar-nav navbar-right">
               <?php
                  nav();
               ?>
               <!-- <li class="active">
                <a href="#">Link <span class="sr-only">(current)</span></a>
               </li>
               <li>
                <a href="#">Link</a>
               </li>
               <li>
                <a href="#">Link</a>
               </li>
               <li>
                <a href="#">Link</a>
               </li> -->
         </ul>
      </div>

<!--       <div class="row">
          
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <div class="logo-wrapper">
                   Online Marketing Solution
              </div>
          </div>
          
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                <div class="nav">
                      <?php nav();?>
                      <div class="clear"></div>
                </div>
          </div>
      </div>
 -->     </div>
  </div>

   <div class="pomotion container">
        <img src="<?php bloginfo('template_directory');?>/images/we_make_websites.png">
        <!-- <div class="big-text">WE MAKE WEBSITES .</div> -->
 </div> 