<?php
/*
The rest of Twenty Twenty-Four functions and definitions goes here
*/


//This file is part of Virtual BLS.
//Virtual BLS is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
//Virtual BLS is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
//You should have received a copy of the GNU General Public License along with Virtual BLS. If not, see <https://www.gnu.org/licenses/>

// Start PHP session early so the session cookie is set before any output
add_action('init', 'vbls_start_session', 1);
function vbls_start_session() {
    if (!session_id()) {
        session_start();
    }
}

add_action('user_register', 'generate_custom_pages', 10, 1);

function generate_custom_pages($user_id) {
    $user = get_userdata($user_id);
    // Use wp-content/themes/users instead of uploads
    $users_root = WP_CONTENT_DIR . '/themes/users';
    wp_mkdir_p($users_root);
    $user_dir = $users_root . '/user_' . $user_id;
    wp_mkdir_p($user_dir);

    // Generate settings.php
    $settings_content = file_get_contents(get_template_directory() . '/templates/settings.php');
    file_put_contents($user_dir . '/settings.php', $settings_content);

    // Generate bls.php
    $activity_content = file_get_contents(get_template_directory() . '/templates/bls.php');
    file_put_contents($user_dir . '/bls.php', $activity_content);

    // Generate get-settings.php
    $get_settings_content = file_get_contents(get_template_directory() . '/templates/get-settings.php');
    file_put_contents($user_dir . '/get-settings.php', $get_settings_content);

    // Generate update-settings.php
    $update_settings_content = file_get_contents(get_template_directory() . '/templates/update-settings.php');
    file_put_contents($user_dir . '/update-settings.php', $update_settings_content);

    // Generate status.php
    $status_content = file_get_contents(get_template_directory() . '/templates/status.php');
    file_put_contents($user_dir . '/status.php', $status_content);
}

// Delete user custom pages directory when a WordPress user account is deleted

function cleanup_user_custom_pages($user_id, $level_id = null, $cancel_level = null) {
	$user_id = intval($user_id);
	if ($user_id <= 0) {
		return;
	}

	$users_root = WP_CONTENT_DIR . '/themes/users';
	$user_dir = $users_root . '/user_' . $user_id;

	if (!is_dir($user_dir)) {
		return;
	}

	require_once ABSPATH . 'wp-admin/includes/file.php';

	if (!function_exists('WP_Filesystem') || !WP_Filesystem()) {
		error_log('WP_Filesystem init failed while deleting user directory for user ID: ' . $user_id);
		return;
	}

	global $wp_filesystem;
	if (empty($wp_filesystem) || !$wp_filesystem->is_dir($user_dir)) {
		return;
	}

	if ($wp_filesystem->delete($user_dir, true)) {
		error_log('User directory deleted for user ID: ' . $user_id);
	} else {
		error_log('Failed to delete user directory for user ID: ' . $user_id);
	}
}

add_action('deleted_user', 'cleanup_user_custom_pages', 10, 1);
add_action('wpmu_delete_user', 'cleanup_user_custom_pages', 10, 1);

function get_user_custom_pages_urls($user_id) {
    $user_dir = 'user_' . $user_id;
    // Build URLs from wp-content/themes/users
    $base_url = content_url('themes/users/' . $user_dir);

    return array(
        'settings'      => $base_url . '/settings.php',
        'bls'           => $base_url . '/bls.php',
        'get_settings'  => $base_url . '/get-settings.php',
        'update_settings'=> $base_url . '/update-settings.php',
        'status'        => $base_url . '/status.php'
    );
}

add_shortcode('user_custom_pages', 'display_user_custom_pages');
    
function display_user_custom_pages() {
    if (!is_user_logged_in()) {
        return 'Please log in to virtualBLS.net to view your custom pages.';
    }

		// Generate an access token for the custom pages
		$_SESSION['settings_page_token'] = bin2hex(random_bytes(32));
		$_SESSION['settings_page_token_time'] = time();

    $user_id = get_current_user_id();
    $urls = get_user_custom_pages_urls($user_id);

	$output = '<hr><br />';
    $output .= '<h3>Start a Session</h3>';

    $output .= '<a href="' . esc_url($urls['settings']) . '" target="_blank"><button style="padding: 20px;
margin: 30px;">Click here to start</button></a></li>';
	
	$output .= '<hr><br />';

    return $output;
}

wp_localize_script('vbls-inline', 'wpData', array(
    // Point to wp-content/themes/users and provide per-user folders
    'baseurl' => content_url('themes/users'),
    'userDir' => is_user_logged_in() ? ('user_' . get_current_user_id()) : null
));

