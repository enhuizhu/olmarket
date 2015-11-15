<?php
 /**
 * all functions that manipulate cms data will be here
 **/
 function milk_clients_admin_action(){
       add_menu_page("Parcel Clients", "Parcel Clients", 1, "Parcel Clients", "clients_admin");
    }
 
 add_action('admin_menu', 'milk_clients_admin_action');
   
 function clients_admin(){
     global $myDb;
	 /**
	 * check if there is any post
	 **/
	 $errors=array();
     
	 if(isset($_POST["addUser"]) && $_POST["addUser"]==1){
	     /**
		 * should check if the user name or adress or phone number is
		 * empty
		 **/
	     if(empty($_POST["userName"])){
             $errors["userName"]="User Name can not be empty!";
		 }

         if(empty($_POST["homeAddress"])){
		     $errors["homeAddress"]="Home Address can not be empty!";
		 }
		 
		 /*if(empty($_POST["email"])){
		     $errors["email"]="Email can not be empty!";
		 }*/
		 
		 
		 if(empty($_POST["phoneNumber"])){
		     $errors["phoneNumber"]="Phone number can not be empty!";
		 }

		 /**
		 * check if the error is empty, if error is empty, then 
		 * add the user info into the database 
		 **/
		 if(empty($errors)){
			if(!$myDb->addUser($_POST)){
			   $errors["dbError"]="There is some database error when adding user to the database!";
			}else{
			   $success="user has been added to the database successfully!";
			}
		 }
		 
	 }
	 
	 	 /**
	 * should get all the users from the database
	 **/
	 $users=$myDb->getUsers();
	 
     include "view/adUser.php";
 }
 
  /**
 * all functions that manipulate cms data will be here
 **/
 function parcelId_admin_action(){
       add_menu_page("Parcel Ids", "Parcel Ids", 1, "Parcel Ids", "parcelId_admin");
    }
 
 add_action('admin_menu', 'parcelId_admin_action');
   
 function parcelId_admin(){
     global $myDb;
	 $errors=array();
     if(isset($_POST["parcelForm"]) && $_POST["parcelForm"]=="1"){
	    /**
		* should check if there is any errors
		**/
        if($myDb->addNewParcel($_POST)){
		    $success="new parcel has been added successfully!";
		}else{
		    $errors=$myDb->errors;
		}
	}
	
	if(isset($_POST["deleteId"]) && !empty($_POST["deleteId"])){
	    if($myDb->deleteParcel($_POST["deleteId"])){
		    $success="parcel has been deleted successfully!";
		}else{
		    $errors["dbErr"]="some error happened in db!";
		}
	}
	
	
	 /**
	 * get all the user
	 **/
     $users=$myDb->getUsers();

     /**
	 * get all the parcels
	 **/
     $parcels=$myDb->getAllParcels();
	 //var_dump($parcels);
	 
	 include "view/adParcelId.php";
 }
 