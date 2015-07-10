<?php
/*
 * Plugin Name: WP User Creator
 * Description: WP User Creator allows an admin to create a user account
 *							with the email address being optional
 * Version: 	0.1.0
 * Author: 		Tony Hetrick
 * Author URI:	http://www.tonyhetrick.com
 * License: 	GNU General Public License (GPL) version 2
 * License URI: https://www.gnu.org/licenses/gpl.html
 */

/*
	GNU General Public License (GPL) version 2
	Copyright (c) [2015] [tonyhetrick.com]
*/

// Wordpress security recommendation
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Version check
// From: https://make.wordpress.org/plugins/2015/06/05/policy-on-php-versions/
if ( version_compare( PHP_VERSION, '5.0', '<' ) ) {
	add_action( 'admin_notices',
		create_function(
			'',
			"echo '<div class=\"error\"><p>" .
			__('WP User Creator requires PHP 5.3 to function properly. Please upgrade PHP or deactivate WP Create User pluging.', 'create_user') .
			"</p></div>';" )
		);
	return;
} else {
	include 'class-user-creator.php';
}

?>
