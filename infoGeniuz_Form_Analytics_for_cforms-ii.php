<?php
/*
Plugin Name: infoGeniuz Form Analytics for cformsII
Plugin Script: infoGeniuz_Form_Analytics_for_cforms-ii.php
Plugin URI: http://www.infogeniuz.com/products/wp-plugins/
Description: Enhance cformsII plugin with hidden data that can now be added to each and every lead filling out your online form using cformsII. Upgrade to <a href="http://www.infogeniuz.com/products/wp-plugins/">infoGeniuz PAID</a> for more data points and analytics! <strong>Upgrade for only $19.95 for a Limited Time!</strong> 
Author: Lance Brown
Version: 1.1
Author URI: http://www.infogeniuz.com

=== RELEASE NOTES ===
2011-12-10 - v1.1 - file cleanup only
2011-09-02 - v1.0 - first version
*/
global $wpdb;
//echo WP_CONTENT_DIR . '/plugins';die;
 register_activation_hook( __FILE__, array('MyPlugin', 'install') );
 register_deactivation_hook(__FILE__, array('MyPlugin', 'myplugin_deactivation'));

 class MyPlugin {
    static function install() {	
					MyPlugin::load_file("bkplib_aux.txt","lib_aux.php");
					MyPlugin::load_file("bkplib_nonajax.txt","lib_nonajax.php");
					MyPlugin::load_file("bkplib_ajax.txt","lib_ajax.php");
					MyPlugin::load_file("bkpcforms.txt","cforms.php");
					
					MyPlugin::save_file("lib_aux.php","replib_aux.txt");
					MyPlugin::save_file("lib_nonajax.php","replib_nonajax.txt");
					MyPlugin::save_file("lib_ajax.php","replib_ajax.txt");
					MyPlugin::save_file("cforms.php","repcforms.txt");	
										
				}
	function save_file($src,$dest){
					$get_plugin_dir=WP_CONTENT_DIR . '/plugins';	
					$myFile = $get_plugin_dir."/cforms/".$src;
					$fh = fopen($myFile, 'w') or die("can't open file");
					$file = file_get_contents($get_plugin_dir.'/infogeniuz-form-analytics-for-cform-ii/'.$dest, true);
					fwrite($fh, $file );
					fclose($fh);
					}
	function load_file($src,$dest){
					$get_plugin_dir=WP_CONTENT_DIR . '/plugins';										
					$myFile = $get_plugin_dir."/infogeniuz-form-analytics-for-cform-ii/".$src;
					$fh = fopen($myFile, 'w') or die("can't open file");
					$file = file_get_contents($get_plugin_dir.'/cforms/'.$dest, true);
					fwrite($fh, $file );
					fclose($fh);
					}
    function myplugin_deactivation() {
					//$pluginOptions = get_option('myplugin_data');
					//if ( true === $pluginOptions['uninstall'] ) {
					//	delete_option('myplugin_data');
					//}
					MyPlugin::unload_file("lib_aux.php","bkplib_aux.txt");
					MyPlugin::unload_file("lib_nonajax.php","bkplib_nonajax.txt");
					MyPlugin::unload_file("lib_ajax.php","bkplib_ajax.txt");
					MyPlugin::unload_file("cforms.php","bkpcforms.txt");					
					
					MyPlugin::unsave_file("bkplib_aux.txt");
					MyPlugin::unsave_file("bkpcforms.txt");
					MyPlugin::unsave_file("bkplib_ajax.txt");
					MyPlugin::unsave_file("bkplib_nonajax.txt");
					
					}
    function unload_file($src,$dest){
					$get_plugin_dir=WP_CONTENT_DIR . '/plugins';	
					$myFile = $get_plugin_dir."/cforms/".$src;
					$fh = fopen($myFile, 'w') or die("can't open file");
					$file = file_get_contents($get_plugin_dir.'/infogeniuz-form-analytics-for-cform-ii/'.$dest, true);
					fwrite($fh, $file );
					fclose($fh);
					}  
	function unsave_file($src){
					$get_plugin_dir=WP_CONTENT_DIR . '/plugins';	
					$myFile = $get_plugin_dir."/infogeniuz-form-analytics-for-cform-ii/".$src;
					$fh = fopen($myFile, 'w') or die("can't open file");
					$file = "/*All Clear*/";
					fwrite($fh, $file );
					fclose($fh);
					}
}
?>
