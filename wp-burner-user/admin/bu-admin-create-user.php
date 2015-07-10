<?php
/*
 * Gets a CSV file from Google Sheets 
 *	
 * LICENSE: GNU General Public License (GPL) version 2
 *
 * @author     Tony Hetrick
 * @copyright  [2015] [tonyhetrick.com]
 * @license    https://www.gnu.org/licenses/gpl.html
*/

# Wordpress security recommendation
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

global $cu_message;

?>

<div class="wrap">
	<h2>WP Create User</h2>
	<p>This tab allows you to create a WordPress user with an optional email address.</p>
	<h3>Fields</h3>
	<ul>
		<li><b>Username:</b> This field is required as this is the login name.</li>
		<li><b>Password:</b> If this field is blank, and random password will be generated (recommended)</li>
		<li><b>Email:</b> This value is used if present, otherwise no email is associated with the new user</li>
	</ul>
	<hr />
	<h3>Add User</h3>
	<form name="get_data" method="post" action="<?php echo CU_Functions::get_server_path_request(); ?>">
		<input type="hidden" name="new_user_submit" value="Y">
		<label><b>Username</b> (required) <input type="text" name="username" /><br />
		<label><b>Password</b> (optional) <input type="text" name="password" /> <br />
		<label><b>Email</b> (optional) <input type="text" name="email" />
		<p class="submit label">
			<input type="submit" name="Submit" value="Create User" /> 
		</p>
	</form>
</div>
<hr />

<?php

# Scan for POST values
$form_submit = CU_Functions::get_POST_string('new_user_submit');

# If the form has been submitted, process the request
if($form_submit == 'Y') {

	$username = trim(CU_Functions::get_POST_string('username'));
	$password = trim(CU_Functions::get_POST_string('password'));
	$email = trim(CU_Functions::get_POST_string('email'));
	
	echo "<hr />";
	
	# Check for blank user
	if ($username == '') {
		$message = "Username was blank.";
		$cu_message->print_message($message, $cu_message->error);
		return;
	}
	
	$user_id = username_exists( $username );
	if ( !$user_id and email_exists($email) == false ) {

		# If password is blank, create a random password
		if ($password == '') {
			$password = wp_generate_password( $length=12, $include_standard_special_chars=false );
		}

		# Create the user and get the ID
		$user_id = wp_create_user( $username, $password, $email );
		
		# Issue the message
		$message = "Successfully created user '$username'. Password: $password";
		$cu_message->print_message($message, $cu_message->success);
		
	} else {
		# User already exists. Issue message.
		$message = __("User '$username' already exists.");
		$cu_message->print_message($message, $cu_message->warning);
	}
}

?>