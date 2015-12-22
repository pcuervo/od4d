<?php

	/**
	* Here we add all the javascript that needs to be run on the footer.
	**/
	function footer_admin_scripts(){
		global $post;
?>
			<script type="text/javascript">
				(function( $ ) {
					"use strict";
					$(function(){

						/**
						 * On load
						**/

						$('#geo-autocomplete').geocomplete({
							details: "#post",
							detailsAttribute: "data-geo"
						});

					});
				}(jQuery));
			</script>

<?php 
	}// footer_admin_scripts