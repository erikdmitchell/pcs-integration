<?php
function pcs_process_results() {
	$pcs_results=new PCS_Results();
	$form=array();
	$html='';

	// setup form //	
	foreach ($_POST['form'] as $arr) :
		$form[$arr['name']]=$arr['value'];
	endforeach;

	// get results //
	$race_results=$pcs_results->race_results($form['pcs_race_id']);
	
	// display output (similar to csv_file_display) //
	if (empty($race_results))
		return;

	$html.='<div class="race-info">';
		$html.='<h4>'.get_the_title($form['race_id']).' <span class="race-date">'.get_post_meta($form['race_id'], '_race_start', true).' - '.get_post_meta($form['race_id'], '_race_end', true).'</span></h4>';
	$html.='</div>';		

	foreach ($race_results as $race_result) :
	
		$html.='<h3>'.$race_result['type'].'</h3>';
	
		$html.='<table class="form-table">';
		
		if (isset($race_result['headers'])) :
			$html.='<tr>';
			
				foreach ($race_result['headers'] as $head) :
					$html.='<th>'.$head.'</th>';
				endforeach;
			
			$html.='</tr>';
		endif;
		
		foreach ($race_result['results'] as $row_counter => $row) :
			$html.='<tr>';
				
				foreach ($row as $key => $col) :
					$html.='<td><input type="text" name="race[results]['.$row_counter.']['.$key.']" class="'.$key.'" value="'.$col.'" /></td>';
				endforeach;
				
			$html.='</tr>';
		endforeach;
	
		$html.='</table>';
	
	endforeach;
	
	echo $html;
	
	wp_die();
}
add_action('wp_ajax_pcs_process_results', 'pcs_process_results');
?>