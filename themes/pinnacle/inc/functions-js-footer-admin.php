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

						$('#geo-autocomplete').geocomplete({
							detailsScope: "#post",
							details: ".details",
							detailsAttribute: "data-geo"
						});
						$('#geo-autocomplete-2').geocomplete({
							detailsScope: "#post",
							details: ".details",
							detailsAttribute: "data-geo"
						});
						// $('#geo-autocomplete-3').geocomplete({
						// 	details: "#post",
						// 	detailsAttribute: "data-geo"
						// });
						// $('#geo-autocomplete-4').geocomplete({
						// 	details: "#post",
						// 	detailsAttribute: "data-geo"
						// });
						// $('#geo-autocomplete-5').geocomplete({
						// 	details: "#post",
						// 	detailsAttribute: "data-geo"
						// });

					});
				}(jQuery));
			</script>
<?php 
	}// footer_admin_scripts