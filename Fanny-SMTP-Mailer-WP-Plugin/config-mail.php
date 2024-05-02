<?php
/**
 * @package fanny_smtp_mailer
 * @version 1.0.1
 */
/*
Plugin Name: Fanny SMTP Mailer
Plugin URI: https://github.com/Fanny-Leicht-Gymnasium/Fanny-SMTP-Mailer-WP-Plugin
Description: Fanny SMTP Mailer is a simple yet powerful plugin designed to streamline the process of configuring SMTP settings for sending emails through your WordPress website. With minimal setup, you can ensure reliable email delivery by specifying SMTP host, port, username, password, and other essential parameters directly from your WordPress admin panel.
Author: Mr_Comand
Version: 1.0.0
Author URI: https://mr-comand.toomanyfiles.dev/
Update URI: https://github.com/Fanny-Leicht-Gymnasium/Fanny-SMTP-Mailer-WP-Plugin
*/
// Add a menu item under Settings
add_action('admin_menu', 'fanny_mailer_menu');

function fanny_mailer_menu()
{
	add_options_page(
		'Fanny Mailer Settings', // Page title
		'Fanny Mailer', // Menu title
		'manage_options', // Capability required to access the page
		'fanny-mailer-settings', // Menu slug
		'fanny_mailer_settings_page' // Function to render the settings page
	);
}

// Function to render the settings page
function fanny_mailer_settings_page()
{
?>
	<div class="wrap">
		<h2>Fanny Mailer Settings</h2>
		<iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>
		<form method="post" action="options.php" target="dummyframe">
			<?php settings_fields('fanny_mailer_settings_group'); ?>
			<?php do_settings_sections('fanny-mailer-settings'); ?>
			<?php submit_button('Save Settings'); ?>
		</form>
	</div>
<?php
}

// Register settings
add_action('admin_init', 'fanny_mailer_register_settings');

function fanny_mailer_register_settings()
{
	// Add a section for SMTP settings
	add_settings_section(
		'fanny_mailer_smtp_section', // Section ID
		'SMTP Settings', // Section title
		'fanny_mailer_smtp_section_callback', // Callback function to render section content
		'fanny-mailer-settings' // Page to which section is added
	);

	// Add fields for SMTP settings
	add_settings_field(
		'fanny_mailer_smtp_host',
		'SMTP Host',
		'fanny_mailer_smtp_host_callback',
		'fanny-mailer-settings',
		'fanny_mailer_smtp_section'
	);
	add_settings_field(
		'fanny_mailer_smtp_port',
		'SMTP Port',
		'fanny_mailer_smtp_port_callback',
		'fanny-mailer-settings',
		'fanny_mailer_smtp_section'
	);
	add_settings_field(
		'fanny_mailer_smtp_username',
		'SMTP Username',
		'fanny_mailer_smtp_username_callback',
		'fanny-mailer-settings',
		'fanny_mailer_smtp_section'
	);
	add_settings_field(
		'fanny_mailer_smtp_password',
		'SMTP Password',
		'fanny_mailer_smtp_password_callback',
		'fanny-mailer-settings',
		'fanny_mailer_smtp_section'
	);
	add_settings_field(
		'fanny_mailer_smtp_from',
		'SMTP from mail',
		'fanny_mailer_smtp_from_callback',
		'fanny-mailer-settings',
		'fanny_mailer_smtp_section'
	);
	add_settings_field(
		'fanny_mailer_smtp_auth',
		'SMTP Auth',
		'fanny_mailer_smtp_auth_callback',
		'fanny-mailer-settings',
		'fanny_mailer_smtp_section'
	);
	add_settings_field(
		'fanny_mailer_smtp_secure',
		'SMTP Secure (TLS/SSl)',
		'fanny_mailer_smtp_secure_callback',
		'fanny-mailer-settings',
		'fanny_mailer_smtp_section'
	);
	add_settings_field(
		'fanny_mailer_smtp_autotls',
		'SMTP AutoTLS',
		'fanny_mailer_smtp_autotls_callback',
		'fanny-mailer-settings',
		'fanny_mailer_smtp_section'
	);
	add_settings_field(
		'fanny_mailer_smtp_debug',
		'SMTP DebugLevel',
		'fanny_mailer_smtp_debug_callback',
		'fanny-mailer-settings',
		'fanny_mailer_smtp_section'
	);

	// Register SMTP settings
	register_setting(
		'fanny_mailer_settings_group',
		'fanny_mailer_smtp_host'
	);
	register_setting(
		'fanny_mailer_settings_group',
		'fanny_mailer_smtp_port'
	);
	register_setting(
		'fanny_mailer_settings_group',
		'fanny_mailer_smtp_username'
	);
	register_setting(
		'fanny_mailer_settings_group',
		'fanny_mailer_smtp_password'
	);
	register_setting(
		'fanny_mailer_settings_group',
		'fanny_mailer_smtp_from'
	);
	register_setting(
		'fanny_mailer_settings_group',
		'fanny_mailer_smtp_auth'
	);
	register_setting(
		'fanny_mailer_settings_group',
		'fanny_mailer_smtp_secure'
	);
	register_setting(
		'fanny_mailer_settings_group',
		'fanny_mailer_smtp_autotls'
	);
    register_setting(
        'fanny_mailer_settings_group',
        'fanny_mailer_smtp_debug',
        array(
            'type' => 'integer',
            'sanitize_callback' => 'absint',
            'default' => 0
        )
    );
    
	// Register more settings as needed
}

// Callback function to render SMTP settings section
function fanny_mailer_smtp_section_callback()
{
	echo '<p>Enter your SMTP settings below:</p>';
}

// Callback functions to render SMTP settings fields
function fanny_mailer_smtp_host_callback()
{
	$smtp_host = get_option('fanny_mailer_smtp_host');
	echo '<input type="text" name="fanny_mailer_smtp_host" value="' . esc_attr($smtp_host) . '" />';
}
function fanny_mailer_smtp_port_callback()
{
	$smtp_port = get_option('fanny_mailer_smtp_port');
	echo '<input type="number" name="fanny_mailer_smtp_port" value="' . esc_attr($smtp_port) . '" />';
}
function fanny_mailer_smtp_username_callback()
{
	$smtp_username = get_option('fanny_mailer_smtp_username');
	echo '<input type="text" name="fanny_mailer_smtp_username" value="' . esc_attr($smtp_username) . '" />';
}
function fanny_mailer_smtp_password_callback()
{
	$smtp_password = get_option('fanny_mailer_smtp_password');
	echo '<input type="password" name="fanny_mailer_smtp_password" value="' . esc_attr($smtp_password) . '" />';
}
function fanny_mailer_smtp_from_callback()
{
	$smtp_from = get_option('fanny_mailer_smtp_from');
	echo '<input type="email" name="fanny_mailer_smtp_from" value="' . esc_attr($smtp_from) . '" />';
}
function fanny_mailer_smtp_auth_callback()
{
	$smtp_auth = get_option('fanny_mailer_smtp_auth');
	if ($smtp_auth) {
		echo '<input type="checkbox" name="fanny_mailer_smtp_auth" checked="" />';
	} else {
		echo '<input type="checkbox" name="fanny_mailer_smtp_auth" />';
	}}
function fanny_mailer_smtp_secure_callback()
{
	$smtp_secure = get_option('fanny_mailer_smtp_secure');
	echo '<input type="text" name="fanny_mailer_smtp_secure" value="' . esc_attr($smtp_secure) . '" />';
}
function fanny_mailer_smtp_autotls_callback()
{
	$smtp_AutoTLS = get_option('fanny_mailer_smtp_autotls');
	if ($smtp_AutoTLS) {
		echo '<input type="checkbox" name="fanny_mailer_smtp_autotls" checked="" />';
	} else {
		echo '<input type="checkbox" name="fanny_mailer_smtp_autotls" />';
	}
}
function fanny_mailer_smtp_debug_callback() {
    $smtp_debug = get_option('fanny_mailer_smtp_debug');
    ?>
    <label><input type="radio" name="fanny_mailer_smtp_debug" value="0" <?php checked($smtp_debug, 0); ?>> None</label><br>
    <label><input type="radio" name="fanny_mailer_smtp_debug" value="1" <?php checked($smtp_debug, 1); ?>> Basic</label><br>
    <label><input type="radio" name="fanny_mailer_smtp_debug" value="2" <?php checked($smtp_debug, 2); ?>> Detailed</label><br>
    <label><input type="radio" name="fanny_mailer_smtp_debug" value="3" <?php checked($smtp_debug, 3); ?>> Full</label><br>
	<label><input type="radio" name="fanny_mailer_smtp_debug" value="4" <?php checked($smtp_debug, 4); ?>> Only Errors</label><br>
	<?php
}

// SMTP Init Settings
add_action('phpmailer_init', 'mail_smtp');
function mail_smtp($phpmailer)
{
	$phpmailer->isSMTP();
	$phpmailer->Host = get_option('fanny_mailer_smtp_host');
	$phpmailer->Port = get_option('fanny_mailer_smtp_port'); 
	$phpmailer->Username = get_option('fanny_mailer_smtp_username');
	$phpmailer->Password = get_option('fanny_mailer_smtp_password');
	$phpmailer->From = get_option('fanny_mailer_smtp_from');

	// Additional settings
	$phpmailer->SMTPAuth = get_option('fanny_mailer_smtp_auth') ? true : false;
	$phpmailer->SMTPSecure = get_option('fanny_mailer_smtp_secure');
	$phpmailer->SMTPAutoTLS = get_option('fanny_mailer_smtp_autotls') ? true : false;

	if (get_option('fanny_mailer_smtp_debug') == 4){
		$phpmailer->SMTPDebug = 2; // Set debug level to 2 for error messages
		
		$phpmailer->Debugoutput = function ($str) {
			// Check if the debug output contains an error message
			if (strpos($str, 'Error:') !== false) {
				// Log only when an error is encountered
				error_log("SMTP Error: $str");
			}
		};
	}else{
		// Filter out client message body and output debug info to the logs
		// NOTE: Log level must be set to '2' or higher in order for the filter to work
		$phpmailer->SMTPDebug = get_option('fanny_mailer_smtp_debug');
		$phpmailer->Debugoutput = function ($str) {
			static $logging = true;
			if ($logging === false && strpos($str, 'SERVER -> CLIENT') !== false) {
				$logging = true;
			}
			if ($logging) {
				error_log("SMTP " . "$str");
			}
			if (strpos($str, 'SERVER -> CLIENT: 354') !== false) {
				$logging = false;
			}
		};
	}
	
}
// Prevent Wordpress from overriding the SMTP FROM address (Office 365 compatibility)
add_filter('wp_mail_from', function ($email) {
	return $_ENV["SMTP_FROM"];
});
