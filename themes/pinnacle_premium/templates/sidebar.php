<?php
$sidebarid = kadence_sidebar_id(); 
if(!empty($sidebarid) && $sidebarid == 'ktwooaccount') {
	get_template_part('templates/account', 'sidebar');
} else {
	dynamic_sidebar( $sidebarid );
}
?>