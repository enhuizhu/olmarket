/**
* all functions about user management will come here
**/
var userManagement={
   /**
   * when click edit button, that td dom should be editable
   * at the same time the content in button should be changed 
   * into edit.
   **/
   bindEvents:function(){
      jQuery("[data-editId]").bind("click",userManagement.editUserInfo);
      jQuery("[data-deleteId]").bind("click",userManagement.deleteUser);
   },
   
   /**
   * function to delete user
   **/
   deleteUser:function(){
      /**
	  * get userId
	  **/
      var userId=jQuery(this).attr("data-deleteId");
	  /**
	  * should call the action of delete user in backoffice
	  **/
	  var that=this;
      jQuery.ajax({
	     url:adminAjax,
		 data:"action=deleteUser&userId="+userId,
		 type:"post",
		 beforeSend:function(xhr){
		    jQuery(that).html("deleting...");
		 },
		 success:function(data){
		    console.log(data);
			var response=JSON.parse(data);
			if(response.error){
			    alert(response.message);
				return false;
			}
			
		    /**
			* delete the whole tr dom
			**/
		    jQuery(that).parent().parent().remove();
		    return true;
		 }
	  });
   },   
   /**
   * function make user's info editable
   **/
   editUserInfo:function(){
     /**
     * change the text
     **/
	 var text=jQuery(this).html();
	 
	 if(text=="Edit"){
	     var editable=true;
		 jQuery(this).html("Save");
	 }else{
	     var editable=false;
		 jQuery(this).html("Edit");
	 }
	 
	 /**
	 * should get its userid first
 	 **/
     var userId=jQuery(this).attr("data-editId");
     console.log("user id:",userId);
	 /**
	 * make content editable
	 **/
	 
	 jQuery("[data-userId="+userId+"] .edit").attr("contenteditable",editable);
	 
     if(editable==false){
	    /**
		* user try to save the edit
		* should get username,useraddress,email,phonenumber
		**/
		var userName=jQuery("[data-userId="+userId+"] .userName").html();
		var homeAddress=jQuery("[data-userId="+userId+"] .homeAddress").html();
		var email=jQuery("[data-userId="+userId+"] .email").html();
		var phoneNumber=jQuery("[data-userId="+userId+"] .phoneNumber").html();
	   
        /**
		* should check if any varible is empty
		**/
        if(userName=="" || homeAddress=="" || email=="" || phoneNumber==""){
           alert("some field has empty value!");
		   return false;
		}

        /**
		* everything is fine, should use ajax to update the client info
		* in the database
		**/
		//alert("will post all the value to server!");
		var data="action=editUser&userName="+userName;
		data+="&homeAddress="+homeAddress;
		data+="&email="+email;
		data+="&phoneNumber="+phoneNumber;
		data+="&userId="+userId;
		
		jQuery.ajax({
		   url:adminAjax,
		   type:"post",
		   data:data,
		   beforeSend:function(xhr){
		      console.log("sending request to amdin!");
		   },
		   success:function(data){
		      console.log("response:",data);
		   }
		})
	}
   }
   
}

jQuery(document).ready(function(){
     userManagement.bindEvents();   
});

