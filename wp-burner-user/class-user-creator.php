<?php
/*
 * The primary Sheets2Table plugin class
 *	
 * LICENSE: GNU General Public License (GPL) version 2
 *
 * @author     Tony Hetrick
 * @copyright  [2015] [tonyhetrick.com]
 * @license    https://www.gnu.org/licenses/gpl.html
*/

# Wordpress security recommendation
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

# Preliminary stuff

// Plugin base dir/url constants
define("CU_PLUGIN_BASE_DIR", plugin_dir_path( __FILE__ ));
define("CU_PLUGIN_BASE_URL", plugins_url('', __FILE__));

$admin_dir = CU_PLUGIN_BASE_DIR . '/' . 'admin';
define('CU_ADMIN_DIR', $admin_dir);

$lib_dir = CU_PLUGIN_BASE_DIR . '/' . 'lib';
define('CU_LIB_DIR', $lib_dir);

// If logged in as admin, enable the admin panel
if ( 'is_admin' ) {
	require_once CU_ADMIN_DIR . '/class-cu-admin.php';
	require_once CU_LIB_DIR . '/cu-functions.php';
}

?>