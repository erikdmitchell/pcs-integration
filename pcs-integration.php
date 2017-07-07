<?php
/**
 * Plugin Name: PCS Integration
 * Plugin URI: 
 * Description: PCS Integration for UCI Results Plugin
 * Version: 1.0.0
 * Author: Erik Mitchell
 * Author URI: http://erikmitchell.net
 * Text Domain: pcs-integration
 */

define('PCS_PATH', plugin_dir_path(__FILE__));
define('PCS_URL', plugin_dir_url(__FILE__));
define('PCS_VERSION', '1.0.0');

include_once(PCS_PATH.'results.php'); // results scrape


function pcs_integration_plugin_updater() {
	if (!is_admin())
		return false;

	if (!defined('WP_GITHUB_FORCE_UPDATE'))
		define('WP_GITHUB_FORCE_UPDATE', true);
		
	$username='erikdmitchell';
	$repo_name='uci-results';
	$folder_name='uci-results';
    
    $config = array(
        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        'proper_folder_name' => $folder_name, // this is the name of the folder your plugin lives in
        'api_url' => 'https://api.github.com/repos/'.$username.'/'.$repo_name, // the github API url of your github repo
        'raw_url' => 'https://raw.github.com/'.$username.'/'.$repo_name.'/master', // the github raw url of your github repo
        'github_url' => 'https://github.com/'.$username.'/'.$repo_name, // the github url of your github repo
        'zip_url' => 'https://github.com/'.$username.'/'.$repo_name.'/zipball/master', // the zip url of the github repo
        'sslverify' => true, // wether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
        'requires' => '4.0', // which version of WordPress does your plugin require?
        'tested' => '4.7', // which version of WordPress is your plugin tested up to?
        'readme' => 'readme.txt', // which file to use as the readme for the version number
    );
   
	new WP_GitHub_Updater($config);
}
//add_action('admin_init', 'uci_results_plugin_updater');
?>
