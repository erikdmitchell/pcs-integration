jQuery(document).ready(function($) {

	$('#add-pcs-race-results').on('click', function(e) {
		e.preventDefault();
		
		var raceID=$('form.process-results #race-id').val();
		var raceSearchID=$('form.process-results #races-list').val();		

		var data={
			'action' : 'pcs_process_results',
			'form' : $('form.process-results').serializeArray()
		};
		
		if (raceID == '') {
			raceID = raceSearchID[0];
		}

		$.post(ajaxurl, data, function(response) {
console.log(response);			
			//$('form#csv-data #race_id').val(raceID);
			
			//$('span#csv-data-form-table').html(response);
			
			//$('.uci-results .button#add-results').show();
		});		
	});

});
