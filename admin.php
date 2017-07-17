<?php

require plugin_dir_path( __FILE__ ) .'classMenu.php';
require plugin_dir_path( __FILE__ ) .'shortcodes.php';
add_action('init', array('menuClass', 'hideMenuBar'));
add_action ('admin_menu', array('menuClass', 'createMenu') );
add_action ('admin_init', array('menuClass', 'menuCallback'));

?>