jQuery(document).ready(function(){

	jQuery('#cngnyc_event-all_day').change(function() {
		if (jQuery(this).is(':checked')) {
			jQuery('.event_date_time').hide();
		} else {
			jQuery('.event_date_time').show();
		}
		
	});
	
	jQuery('#cngnyc_event a.action#add_street_address').click(function() {
		jQuery(this).remove()
		jQuery('#street_address_wrap').show();
		return false;
	});
	
	
});