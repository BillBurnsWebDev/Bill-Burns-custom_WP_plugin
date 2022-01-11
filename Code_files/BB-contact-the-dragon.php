<?php
/*
Plugin Name: Contact the Dragon
Plugin URI: 104.236.33.23
Description: Simple WordPress Contact Form
Version: 1.0
Author: Bill Burns
Author URI: 104.236.33.23
*/
/* Function to create simple contact email form (standard HTML & PHP requests) [START] */ 
function html_form_code()
{
/* block of code for <form> [START] */ 
	echo '<form class="cfFormDD" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
/* create a grid container [START] */
	echo "<div class='cfGridContainDD'>";
/* "title" of contact form */	
	echo '<div id="item-1"><h2 class="cfTitleDD">We would love to hear from you!</h2></div>';
/* "first name" & "last name" fields of the form [START] */ 	
	echo '<p>';
/*		echo '<div id="item-2">Your Name<br /><br /></div>'; */
		echo '<div id="item-3" class="cfTextboxDD">First Name: <input type="text" placeholder="required" name="cf-fname" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-fname"] ) ? esc_attr( $_POST["cf-fname"] ) : '' ) . '" size="40" /> <br /></div>';
		echo '<div id="item-4" class="cfTextboxDD">Last Name: <input type="text" placeholder="required" name="cf-lname" pattern="[a-zA-Z0-9 ]+" value="' . ( isset( $_POST["cf-lname"] ) ? esc_attr( $_POST["cf-lname"] ) : '' ) . '" size="40" /></div>';
	echo '</p>';
/* "first name" & "last name" fields of the form [END] */
/* "phone" field of the form [START] */     
	echo '<p>';
/*		echo '<div id="item-5">Your Phone Number <br /><span style="color:red; font-size:.7em;"><sup>*</sup></span><br /></div>'; */
		echo '<div id="item-6" class="cfTextboxDD">Phone Number: <input type="text" placeholder="required" name="cf-phone" value="' . ( isset( $_POST["cf-phone"] ) ? esc_attr( $_POST["cf-phone"] ) : '' ) . '" size="40" /></div>';
	echo '</p>';
/* "phone" field of the form [END] */  
/* "email" field of the form [START] */  
	echo '<p>';
/*		echo '<div id="item-7">Your Email <br /><span style="color:red; font-size:.7em;"><sup>*</sup></span><br /></div>'; */
		echo '<div id="item-8" class="cfTextboxDD">Email: <input  type="text" placeholder="required" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" /></div>';
	echo '</p>';
/* "email" field of the form [END] */ 
/* "subject" field of the form [START] */
	echo '<p>';
/*		echo '<div id="item-9">Subject<br /><span style="color:red; font-size:.7em;"><sup>*</sup></span><br /></div>'; */
		echo '<div id="item-10" class="cfTextboxDD">Subject: <input type="text" placeholder="required" name="cf-subject" value="' . ( isset( $_POST["cf-subject"] ) ? esc_attr( $_POST["cf-subject"] ) : '' ) . '" size="40" /></div>';
	echo '</p>';
/* "subject" field of the form [END] */
/* "message" field of the form [START] */
	echo '<p>';
/*		echo '<div id="item-11">Message<br /><span style="color:red; font-size:.7em;"><sup>*</sup></span><br /></div>'; */
		echo '<div id="item-12"><textarea class="cfTextareaDD" placeholder="Please type your message here (required)" rows="10" cols="35" name="cf-message">' . ( isset( $_POST["cf-message"] ) ? esc_attr( $_POST["cf-message"] ) : '' ) . '</textarea></div>';
	echo '</p>';
/* "message" field of the form [END] */

	echo '<div id="item-13" class="cfSubButtonDD"><p><input type="submit" name="cf-submitted" value="Come on, you can do it ... CLICK HERE"/></p></div>'; // "submit" button of the form 
	echo "</div>";
/* create a grid container [END] */ 

echo '</form>';
/* block of code for <form> [END] */ 

}
/* Function to create simple contact email form (standard HTML & PHP requests) [END] */
//Check and clean the email of any disturbing stuffola and then send it out
function deliver_mail() {
// if the submit button is clicked, send the email -- note that above the submit button is named "cf_submitted
    if ( isset( $_POST['cf-submitted'] ) ) { 
// sanitize form values -- each line checks the input that carries that name from above
         $fname    = sanitize_text_field( $_POST["cf-fname"] );
         $lname    = sanitize_text_field( $_POST["cf-lname"] );
         //Using $fname replacing the function "sanitize_email" in place of "santitize_text_field" create a sanitize statement for email
         //Using $fname as an example create a sanitize statement for subject
         $message  = esc_textarea( $_POST["cf-message"] );
         //This creates a variable that will return "Firstname Lastname"
         //notice the insertion of a spacebar surrounded in quotes (in php a "." acts like a "+" sign)
         $name = $fname . " " . $lname;
        // the get_option() function retrieves the blog administrator's email address
        //as an alternate you could just set this variable $to = 'johndoe@highline.com' (or any email address in quotes)
        $to = get_option( 'admin_email' );
        $headers = "From: $name <$email>" . "\r\n"; //creates header variable for email and adds the name and email address to the variable
// If everything is okay and an email has been processed for sending, display a success message for the customer
        if ( wp_mail( $to, $subject, $message, $headers ) ) { 
            echo '<div>';
            echo '<p>Thank you for contacting us! We will be in touch right away.</p>';
            echo '</div>';
        } else { //If everything is not okay send this message to the customer
            echo 'An unexpected error occurred';
        }
    }
}
//This function calls the deliver_mail and html_form_code 
function cf_shortcode() {
    ob_start(); //This PHP function turns on auto buffering
    deliver_mail(); //Calls the function
    html_form_code(); // calls the function
    return ob_get_clean(); //Discards the buffer contents
}
//This function registers my shortcode with WordPress and calls the function above = cf_shortcode
add_shortcode( 'BB-contact-the-dragon', 'cf_shortcode' );
//You need to be sure to put your plugin name in the above function!!!!!!!!
?>