<?php
function pcs_process_results() {
	$pcs_results=new PCS_Results();
	$form=array();
	
	foreach ($_POST['form'] as $arr) :
		$form[$arr['name']]=$arr['value'];
	endforeach;

print_r($form);

	$results=$pcs_results->race_results($form['pcs_race_id']);
	
print_r($results);
// get results in array w/ race_id, header, rows
// then display
	
	wp_die();
}
add_action('wp_ajax_pcs_process_results', 'pcs_process_results');
	/*
				if (empty($arr))
			return;
			
		$html='';
		
		$html.='<div class="race-info">';
			$html.='<h4>'.get_the_title($arr['race_id']).' <span class="race-date">'.get_post_meta($arr['race_id'], '_race_date', true).'</span></h4>';
		$html.='</div>';		
		
		$html.='<table class="form-table">';
		
		if (isset($arr['header'])) :
			$html.='<tr>';
			
				foreach ($arr['header'] as $head) :
					$html.='<th>'.$head.'</th>';
				endforeach;
			
			$html.='</tr>';
		endif;
		
		foreach ($arr['rows'] as $row_counter => $row) :
			$html.='<tr>';
				
				foreach ($row as $key => $col) :
					$html.='<td><input type="text" name="race[results]['.$row_counter.']['.$key.']" class="'.$key.'" value="'.$col.'" /></td>';
				endforeach;
				
			$html.='</tr>';
		endforeach;

		$html.='</table>';
		
		return $html;
		*/
?>