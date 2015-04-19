<!-- include bootrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- include customize css -->

<link rel="stylesheet" href="<?php echo plugins_url( 'css/style.css' , __FILE__ ) ?>">


<ul class="nav nav-tabs" role="tablist">
    <li class="dropdown active">
      <a class="dropdown-toggle" data-toggle="dropdown" href="">
        Category Management<span class="caret"></span>
      </a>
      <ul class="dropdown-menu" role="menu">
          <li>
          	 <a href="#createCategory">Create New Category</a>
          </li>
          <li>
          	<a href="#listCategory">List All Categories</a>
          </li>
      </ul>
    </li>
    <li class="dropdown active">
       <a class="ropdown-toggle" data-toggle="dropdown" href="">Product Management<span class="caret"></span></a>
       <ul class="dropdown-menu" role="menu">
          <li>
            <a href="#addItem">Add New Item</a>
          </li>
          <li>
            <a href="#listItems">List Items</a>
          </li>
       </ul>
       

    </li>
</ul>

