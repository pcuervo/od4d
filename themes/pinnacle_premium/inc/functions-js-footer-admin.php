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

						if (document.getElementById("geo-autocomplete-a")) {
							var autocomplete = new google.maps.places.Autocomplete($("#geo-autocomplete-a")[0], {});

				            google.maps.event.addListener(autocomplete, 'place_changed', function() {
				                var place = autocomplete.getPlace();

				                $('#lat-a').val( place.geometry.location.lat() );
				                $('#lng-a').val( place.geometry.location.lng() );
				            });
				        }

				        if (document.getElementById("geo-autocomplete-b")) {
							var autocompletea = new google.maps.places.Autocomplete($("#geo-autocomplete-b")[0], {});

				            google.maps.event.addListener(autocompletea, 'place_changed', function() {
				                var placea = autocompletea.getPlace();

				                $('#lat-b').val( placea.geometry.location.lat() );
				                $('#lng-b').val( placea.geometry.location.lng() );
				            });
				        }

				        if (document.getElementById("geo-autocomplete-c")) {
							var autocompleteb = new google.maps.places.Autocomplete($("#geo-autocomplete-c")[0], {});

				            google.maps.event.addListener(autocompleteb, 'place_changed', function() {
				                var placeb = autocompleteb.getPlace();

				                $('#lat-c').val( placeb.geometry.location.lat() );
				                $('#lng-c').val( placeb.geometry.location.lng() );
				            });
				        }

				        if (document.getElementById("geo-autocomplete-d")) {
							var autocompletec = new google.maps.places.Autocomplete($("#geo-autocomplete-d")[0], {});

				            google.maps.event.addListener(autocompletec, 'place_changed', function() {
				                var placec = autocompletec.getPlace();

				                $('#lat-d').val( placec.geometry.location.lat() );
				                $('#lng-d').val( placec.geometry.location.lng() );
				            });
				        }

				        if (document.getElementById("geo-autocomplete-e")) {
							var autocompletee = new google.maps.places.Autocomplete($("#geo-autocomplete-e")[0], {});

				            google.maps.event.addListener(autocompletee, 'place_changed', function() {
				                var placee = autocompletee.getPlace();

				                $('#lat-e').val( placee.geometry.location.lat() );
				                $('#lng-e').val( placee.geometry.location.lng() );
				            });
				        }

					});
				}(jQuery));
			</script>

<?php 
	}// footer_admin_scripts

