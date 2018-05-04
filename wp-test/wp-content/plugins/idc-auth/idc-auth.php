<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           IDC_AUTH
 *
 * @wordpress-plugin
 * Plugin Name:       IDC Authentication System
 * Plugin URI:        http://rivittcollective.com/
 * Description:       This plugin allows authentication against the IDCWin.ca website
 * Version:           1.0.0
 * Author:            Rivitt Collective
 * Author URI:        http://rivittcollective.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       idc-auth
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


if ( !function_exists('wp_authenticate') ) :
    /**
     * Authenticate a user, confirming the login credentials are valid.
     *
     * @since 2.5.0
     * @since 4.5.0 `$username` now accepts an email address.
     *
     * @param string $username User's username or email address.
     * @param string $password User's password.
     * @return WP_User|WP_Error WP_User object if the credentials are valid,
     *                          otherwise WP_Error.
     */
    function wp_authenticate($username, $password) {
        $username = sanitize_user($username);
        $password = trim($password);

        /**
         * Filters whether a set of user login credentials are valid.
         *
         * A WP_User object is returned if the credentials authenticate a user.
         * WP_Error or null otherwise.
         *
         * @since 2.8.0
         * @since 4.5.0 `$username` now accepts an email address.
         *
         * @param null|WP_User|WP_Error $user     WP_User if the user is authenticated.
         *                                        WP_Error or null otherwise.
         * @param string                $username Username or email address.
         * @param string                $password User password
         */
        $user = apply_filters( 'authenticate', null, $username, $password );

        if ( $user == null ) {
            // TODO what should the error message be? (Or would these even happen?)
            // Only needed if all authentication handlers fail to return anything.
            $user = new WP_Error( 'authentication_failed', __( '<strong>ERROR</strong>: Invalid username, email address or incorrect password.' ) );
        }

        $ignore_codes = array('empty_username', 'empty_password');

        if (is_wp_error($user) && !in_array($user->get_error_code(), $ignore_codes) ) {
            /**
             * Fires after a user login has failed.
             *
             * @since 2.5.0
             * @since 4.5.0 The value of `$username` can now be an email address.
             *
             * @param string $username Username or email address.
             */

            // authenticate against the production system and create a local user to match
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://idcwin.ca/cms/login",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "site=idcwin&wsHost=www&wsDomain=mgainvestmentservices.com&wsProtocol=https&wfmGroupName=wfmAdvisor&idcGroupName=idcwinAdvisor&wsiGroupName=wsiAdvisor&doRemoteJBossLoginFunctionString=true&doRemoteEWMSLoginFunctionString=true&remoteJBossDomain=CCWEIP01v%3A8080&remoteJBossProtocol=http&currentSiteName=idcwin&username=" . $username . "&password=" . $password,
                CURLOPT_HTTPHEADER => array(
                    "cache-control: no-cache",
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $responseCurl = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                do_action( 'wp_login_failed', $username );
            } else {
                if (strpos($responseCurl, '<title>Login') === false) {
                    $user_id = username_exists($username);
                    if ( $user_id !== false ) {
                        // Login as an existing user
                        $user = new WP_User($user_id);
                    } else {
                        // Create the new user and login as them
                        $user_email = $username . '@idcwin.ca';
                        if ( !$user_id and email_exists($user_email) == false ) {
                            $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
                            $user_id = wp_create_user( $username, $random_password, $user_email );
                            $user = new WP_User($user_id);
                        } else {
                            $random_password = __('User already exists.  Password inherited.');
                            $user = new WP_User($user_id);
                        }
                    }
                } else {
                    do_action( 'wp_login_failed', $username );
                }
            }
        }

        return $user;
    }
endif;

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'IDC_AUTH_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-idc-auth-activator.php
 */
function activate_IDC_AUTH() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-idc-auth-activator.php';
	IDC_AUTH_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-idc-auth-deactivator.php
 */
function deactivate_IDC_AUTH() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-idc-auth-deactivator.php';
	IDC_AUTH_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_IDC_AUTH' );
register_deactivation_hook( __FILE__, 'deactivate_IDC_AUTH' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-idc-auth.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_IDC_AUTH() {

	$plugin = new IDC_AUTH();
	$plugin->run();

}
run_IDC_AUTH();