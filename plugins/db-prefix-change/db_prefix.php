<?php
/*
Plugin Name: Change Database Prefix
Plugin URI: http://www.creativedev.in
Description: a plugin to change database prefix
Version: 1.3
Date: 08-9-2015
Author: Ms. Bhumi Shah improvements by Felix Wagemakers
Author URI: http://www.creativedev.in
*/
 
function dbprefix_insertFrontEndScripts(){
	wp_register_style('dbStyle',plugins_url('/css/style.css',__FILE__));
	wp_enqueue_style('dbStyle');
	wp_register_script('jquery.validate',plugins_url('/js/jquery.validate.min.js',__FILE__),array('jquery'), false, false);
	wp_enqueue_script('jquery.validate');
	wp_register_script('util',plugins_url('/js/util.js',__FILE__),array('jquery'), false, false);
	wp_enqueue_script('util');
}
function dbprefix_wpConfigCheckPermissions($wpConfigFilePath)
{
	if (!is_writable($wpConfigFilePath)) {
		return false;
	}
	// We use these functions later to access the wp-config file
	// so if they're not available we stop here
	if (!function_exists('file') || !function_exists('file_get_contents') || !function_exists('file_put_contents'))
	{
		return false;
	}
	return true;
}

function dbprefix_updateWpConfigTablePrefix($dbprefix_wpConfigFile, $oldPrefix, $newPrefix)
{
	// Check file' status's permissions
	if (!is_writable($dbprefix_wpConfigFile))
	{
		return -1;
	}

	if (!function_exists('file')) {
		return -1;
	}

	// Try to update the wp-config file
	$lines = file($dbprefix_wpConfigFile);
	$fcontent = '';
	$result = -1;
	foreach($lines as $line)
	{
		$line = ltrim($line);
		if (!empty($line)){
			if (strpos($line, '$table_prefix') !== false){
				$line = preg_replace("/=(.*)\;/", "= '".$newPrefix."';", $line);
			}
		}
		$fcontent .= $line;
	}
	if (!empty($fcontent)){
		// Save wp-config file
		$result = file_put_contents($dbprefix_wpConfigFile, $fcontent);
	}

	return $result;
}
function dbprefix_getTablesToAlter()
{
	global $wpdb;
	return $wpdb->get_results("SHOW TABLES LIKE '".$GLOBALS['table_prefix']."%'", ARRAY_N);
}
function dbprefix_renameTables($tables, $currentPrefix, $newPrefix)
{
	global $wpdb;
	$changedTables = array();
	foreach ($tables as $k=>$table)	{
		$tableOldName = $table[0];
		// Hide errors
		$wpdb->hide_errors();

		// To rename the table
		$tableNewName = substr_replace($tableOldName, $newPrefix, 0, strlen($currentPrefix));
		$wpdb->query("RENAME TABLE `{$tableOldName}` TO `{$tableNewName}`");
		array_push($changedTables, $tableNewName);

	}
	return $changedTables;
}
function dbprefix_renameDbFields($oldPrefix,$newPrefix)
{
	global $wpdb;		
	/*
	 * usermeta table
	 *===========================
	 wp_*
	* options table
	* ===========================
	wp_user_roles
	*/
	$str = '';
	if (false === $wpdb->query("UPDATE {$newPrefix}options SET option_name='{$newPrefix}user_roles' WHERE option_name='{$oldPrefix}user_roles';")) {
		$str .= '<br/>Changing value: '.$newPrefix.'user_roles in table <strong>'.$newPrefix.'options</strong>: <font color="#ff0000">Failed</font>';
	}
	$query = 'update '.$newPrefix.'usermeta set meta_key = CONCAT(replace(left(meta_key, ' . strlen($oldPrefix) . "), '{$oldPrefix}', '{$newPrefix}'), SUBSTR(meta_key, " . (strlen($oldPrefix) + 1) . ")) where meta_key in ('{$oldPrefix}autosave_draft_ids', '{$oldPrefix}capabilities', '{$oldPrefix}metaboxorder_post', '{$oldPrefix}user_level', '{$oldPrefix}usersettings','{$oldPrefix}usersettingstime', '{$oldPrefix}user-settings', '{$oldPrefix}user-settings-time', '{$oldPrefix}dashboard_quick_press_last_post_id')";
	if (false === $wpdb->query($query)) {
		$str .= '<br/>Changing values in table <strong>'.$newPrefix.'usermeta</strong>: <font color="#ff0000">Failed</font>';
	}
	if (!empty($str)) {
		$str = '<br/><p>Changing database prefix:</p><p>'.$str.'</p>';
	}
	return $str;
}


function dbprefix_admin() {
	include('dbprefix_admin.php');
}
function dbprefix_admin_actions() {
	add_options_page("Change DB Prefix", "Change DB Prefix", 'manage_options', "Change-DB-Prefix", "dbprefix_admin");
}
add_action('admin_enqueue_scripts','dbprefix_insertFrontEndScripts');
add_action('admin_menu', 'dbprefix_admin_actions');
?>