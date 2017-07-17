<?php 
class menuClass {
	public static function createMenu() {
		add_menu_page( 
		'page_title',
		'menu title',
		'manage_options',	
		'menu_slug',
		array ('menuClass','menuCallback'),
		'dashicons-image-filter',
		6
		);
		add_submenu_page('menu_slug',
		'submenu',
		'title',
		'administrator',
		'submenu_slug',
		'menu_callback');
	}
	public static function menuCallback() {
		?>
	<form action="options.php" method="post">
	<?php 
	settings_fields('our_settings_group');
	?>
	<input id="hide-admin" type="checkbox" name="first_option" value="yes" <?php checked( get_option('first_option'), 'yes')?>>
	<label for="hide_admin">hide admin bar in frontend? </label>
	<?php submit_button('save'); ?>
	</form>
	<?php
	}
	public static function hideMenubar() {
		$option=get_option('first_option');
	if ($option ==='yes')
			add_filter('show_admin_bar', '__return_false');
	}
	public static function registerSetting() {
		register_setting('our_settings_group', 'first_option');
	}
}