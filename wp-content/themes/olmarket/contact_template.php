<?php
/**
Template Name: Contact
**/
if(isset($_POST) && !empty($_POST)){
	/**
	* should check if user alreay fill all the field
	**/
	if(empty($_POST["email"]) || empty($_POST["username"]) || empty($_POST["usercomment"])){
	    $contact_error = "Please fill all the fields";
	}else if(!preg_match("/^.*@.*$/", $_POST["email"])){
        $contact_error = "The email is invalid";
	}

	if(!isset($contact_error)){
        $to = "sunlilyy@gmail.com";
        $subject="contact us";
        // To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		// Additional headers
		$headers .= 'To: developer<zhuen2000@163.com>' . "\r\n";
		$headers .= 'From: olmarket <info@olmarket.co.uk>' . "\r\n";
	    
        $message="<table width='500'>
           <tr>
              <td width='150'>
                <strong>User Name:</strong>
              </td>
              <td>
                ".$_POST["username"]."
              </td>
           </tr>
           <tr>
              <td>
                <strong>User Message:</strong>
              </td>
              <td>
               ".$_POST["usercomment"]."
              </td>
           </tr>
           <tr>
              <td>
                <strong>User mail:</strong>
              </td>
              <td>
               ".$_POST["email"]."
              </td>
           </tr>
        </table>
        ";

        //die(var_dump($message));
	    if(mail($to,$subject,$message,$headers)){
	    	$success="Email has been sent successfully!";
	    }else{
	    	$contact_error="Can not send email, please check your server settting.";
	    }
	} 
}

get_header();
include "contents/contact_us.php";
get_footer();
?>