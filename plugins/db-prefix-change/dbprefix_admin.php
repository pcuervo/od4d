<?php 
global $wpdb;
$bprefix_Message="";
$bprefix_prefix=$wpdb->prefix;
if((isset($_POST['dbprefix_hidden']) && $_POST['dbprefix_hidden']=='Y') && (isset($_POST['Submit']) && trim($_POST['Submit'])=='Save Changes')) { 
	//Form data sent
	$old_dbprefix = $_POST['dbprefix_old_dbprefix'];
	update_option('dbprefix_old_dbprefix', $old_dbprefix);
	$dbprefix_new = $_POST['dbprefix_new'];
	update_option('dbprefix_new', $dbprefix_new);
	$wpdb =& $GLOBALS['wpdb'];
	$new_prefix = preg_replace("/[^0-9a-zA-Z_]/", "", $dbprefix_new);
	$dbprefix_class="dbprefix-error";
	if($_POST['dbprefix_new'] =='' || strlen($_POST['dbprefix_new']) < 2 ){$bprefix_Message .= 'Please provide a proper table prefix.';}
		else if ($new_prefix == $old_dbprefix) {$bprefix_Message .= 'No change! Please provide a new table prefix.';}
		else if (strlen($new_prefix) < strlen($dbprefix_new)){
			$bprefix_Message .='You have used some characters disallowed for the table prefix. Please use allowed characters instead of <b>'. $dbprefix_new .'</b>';
		}	else {		
			$tables = dbprefix_getTablesToAlter();
			if (empty($tables)) {
				$bprefix_Message .= dbprefix_eInfo('There are no tables to rename!');
			}	else {
				$result = dbprefix_renameTables($tables, $old_dbprefix, $dbprefix_new);
				// check for errors
				if (!empty($result)){
					$bprefix_Message .='All tables have been successfully updated with prefix <b>'.$dbprefix_new.'</b> !<br/>';
					// try to rename the fields
					$bprefix_Message .= dbprefix_renameDbFields($old_dbprefix, $dbprefix_new);
					$dbprefix_wpConfigFile= ABSPATH.'wp-config.php';
					if (dbprefix_updateWpConfigTablePrefix($dbprefix_wpConfigFile, $old_dbprefix, $dbprefix_new)){
						$bprefix_Message .= 'The wp-config file has been successfully updated with prefix <b>'.$dbprefix_new.'</b>!';
						$dbprefix_class="dbprefix-success";
					}	else {
						$bprefix_Message .= 'The wp-config file could not be updated! You have to manually update the table_prefix variable to the one you have specified: '.$dbprefix_new;
					}
					// End if tables successfully renamed
					$bprefix_prefix=$dbprefix_new;
				}	else {
					$bprefix_Message .= 'An error has occurred and the tables could not be updated!';
				}
				$_POST['dbprefix_hidden'] = 'n';	
			} 
	}	
} else {
	//Normal page display
	$dbhost = get_option('dbprefix_dbhost');
	$dbname = get_option('dbprefix_dbname');
	$dbuser = get_option('dbprefix_dbuser');
	$dbpwd = get_option('dbprefix_dbpwd');
	$dbprefix_exist = get_option('dbprefix_prefix_exist');
	$dbprefix_new = get_option('dbprefix_new');
}
?>
<!DOCTYPE html>
<div class="wrap" id="cdp-wrap-div">
  <?php    echo "<h2 class='hndle'>" . __( 'Change DB Prefix', 'oscimp_trdom' ) . "</h2>"; ?>
  <form id="dbprefix_form" name="dbprefix_form" method="post" action="" >
    <input type="hidden" name="dbprefix_hidden" value="Y">
		<div id="cdtp" class="postbox">
			<h3 class="hndle" style="cursor: default;"><span>Database Prefix Settings</span></h3>
			<div class="inside">
			  <div class="cdp">
			    <h4 style="margin-top: 15px;">Before execute this plugin:</h4>
			    <ul class="cdp-data" style="margin-top: 20px;">
			      <li>Make sure your <code>wp-config.php</code> file must be <strong>writable</strong>.</li>
			      <li>And check the database must have <strong>ALTER</strong> rights.</li>
			    </ul>
			  </div><!-- cdp div -->
			  <div class="success <?php print $dbprefix_class; ?>" ><?php  echo $bprefix_Message; ?></div><!-- success div -->
			  <?php if(isset($_POST['dbprefix_hidden']) && $_POST['dbprefix_hidden']=='Y') { ?>
				  <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div><!-- updated div -->
			  <?php } ?>
			  <div class="cdp-container">
			  	<label for="dbprefix_old_dbprefix" class="lable01">
				  	<span class="ttl02">
						  <?php _e("Existing Prefix: " ); ?>
						  <span class="required">*</span>
						</span>
					  <input type="text" name="dbprefix_old_dbprefix" id="dbprefix_old_dbprefix" value="<?php print $bprefix_prefix; ?>" size="20" required>
					  <?php _e(" ex:wp_" ); ?>
					  <span class="error"></span>
				  </label>
				  <label for="dbprefix_new" class="lable01">
				  	<span class="ttl02">
						  <?php _e("New Prefix: " ); ?>
						  <span class="required">*</span>
						</span>
					  <input type="text" name="dbprefix_new" value="" size="20" id="dbprefix_new" required>
					  <?php _e(" ex: uniquekey_" ); ?>
				  </label>
				  <p class="margin-top:10px"><b>Allowed characters:</b> all latin alphanumeric as well as the <strong>_</strong> (underscore).</p>
				  <p class="submit"><input type="submit" name="Submit" class="button button-primary" value="<?php _e('Save Changes', 'dbprefix_trdom' ) ?>" /></p>
				</div><!-- container div -->
			</div><!-- inside div -->
		</div><!-- postbox div -->
  </form>
</div><!-- wrap div -->