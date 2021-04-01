<?php
/** @noinspection PhpUnused */

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://booskills.com/rao
 * @since             1.0.0
 * @package           TeamGrid
 *
 * @wordpress-plugin
 * Plugin Name:       Team Grid
 * Plugin URI:        https://boospot.com/
 * Description:       To create a Team Grid
 * Requires PHP:      7.0
 * Requires at least: 5.0
 * Tested up to:      5.3
 * Version:           1.0.0
 * Author:            Rao
 * Author URI:        https://booskills.com/rao
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       team-grid
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TEAM_GRID_VERSION', '1.0.0' );

define( 'TEAM_GRID_NAME', 'team-grid' );

/**
 * Plugin base name.
 * used to locate plugin resources primarily code files
 * Start at version 1.0.0
 */
/** @noinspection PhpUnused */
define( 'TEAM_GRID_BASE_NAME', basename( __FILE__ ) );


/**
 * Plugin base dir path.
 * used to locate plugin resources primarily code files
 * Start at version 1.0.0
 */
/** @noinspection PhpUnused */
define( 'TEAM_GRID_DIR_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Plugin url to access its resources through browser
 * used to access assets images/css/js files
 * Start at version 1.0.0
 */
/** @noinspection PhpUnused */
define( 'TEAM_GRID_URL_PATH', plugin_dir_url( __FILE__ ) );

/**
 * Composer Auto Loader
 */
require_once 'vendor/autoload.php';


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-skeleton-activator.php
 */
function team_grid_activate() {
	TeamGrid\Activator::activate();

}

register_activation_hook( __FILE__, 'team_grid_activate' );
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-skeleton-deactivator.php
 */
function team_grid_deactivate() {
	TeamGrid\Deactivator::deactivate();
}

register_deactivation_hook( __FILE__, 'team_grid_deactivate' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function team_grid() {

	return TeamGrid\Init::get_instance();

}

team_grid();