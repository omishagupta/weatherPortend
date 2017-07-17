<?php
/*
* Plugin Name:       rtCamp
 * Plugin URI:        github link
 * Description:       we give you functionality to swipe
 * Version:           1.0.0
 * Author:            Omisha
 * Author URI:        github link
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */
if (!class_exists('learnwp')):
 final class learnwp {
	private static $instance =null;
	private function __construct() {
		$this->initializeHooks();
	}
	public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
            return self::$instance;
        }
    }
	 private function initializeHooks() {
			require plugin_dir_path( __FILE__ ) .'menu.php';
         require plugin_dir_path( __FILE__ ) .'shortcodes.php';
			add_action('admin_bar_menu', 'add_own_menu');
			add_filter('admin_footer_text', 'custom_fiiter_string');
             add_shortcode( 'weather', array('weatherized','weatherShortcode'));

     }

}
endif;
function custom_fiiter_string($text) {
	return '<p style="color: blue"> A product of DAIICT </p>' . $text;
}
learnwp::getInstance();

function add_own_menu() {
	global $wp_admin_bar;
	$custom_menu= array(
	'id' => 'Omisha',
	'title' => 'Omisha',
	'parent' => 'top-secondary',
	'href'=> site_url()
	);
	$wp_admin_bar->add_node($custom_menu);
}


?>