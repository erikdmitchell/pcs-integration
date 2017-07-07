<?php
function pcs_process_results() {
	print_r($_POST);
	
	wp_die();
}
add_action('wp_ajax_pcs_process_results', 'pcs_process_results');
	/*
		race_id
Header
rows
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