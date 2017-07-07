<?php

class PCS {
	
	protected $base_url='http://www.procyclingstats.com/';
	
	public function __construct() {
		include_once(PCS_PATH.'simple_html_dom.php');
	}
	
	public function race_results($url='') {
		$result_links=$this->race_result_urls($url);
		
		foreach ($result_links as $result_link) :
			$this->get_results($result_link['url']);
		endforeach;
	}
	
	protected function race_result_urls($url='') {
		$html=file_get_html($url);
		$result_links=array();
		
		foreach ($html->find('.content .subs a.ResultQuickNav') as $link) :
			$arr=array(
				'type' => $link->innertext,
				'url' => $this->base_url.'race.php'.$link->href,
			);
			
			$result_links[]=$arr;
		endforeach;
		
		return $result_links;		
	}
	
	protected function get_results($url='') {
		$html=file_get_html($url);
		$fields_to_ignore=array('pcs', 'km/h');
		$keys_to_skip=array();
		$headers=array();
		$race_results=array();
		
		parse_str($url, $url_arr);
echo "<p>$url</p>";		
		// get results //
		foreach ($html->find('.res'.$url_arr['id']) as $element)
			$results=$element;
			
		// get headers //
		foreach ($results->find('div b') as $key => $element) :
			if (in_array(strtolower($element->plaintext), $fields_to_ignore))
				$keys_to_skip[]=$key;
				
			$headers[]=strtolower($element->plaintext);
		endforeach;
		
		// get results //
		foreach ($results->find('.result .line') as $line) :
			$arr=array();
			
			foreach ($line->find('span.show') as $key => $span) :
				$value=trim(str_replace('&nbsp;', '', $span->plaintext));
				
				switch ($headers[$key]) :
					case 'rider':
						foreach ($span->find('a') as $a) :
							foreach ($a->find('span') as $el) :
								$last=$el->innertext;
							endforeach;
							
							$first=trim(str_replace($last, '', $a->plaintext));
							$value=$first.' '.$last;
						endforeach;
						break;
					case 'uci':
						if (empty($value) || $value=='') :
							$value=0;
						endif;
						break;
					case 'time':
						// remove chars //
						$time=$span->innertext;
						
						foreach ($span->find('span.time') as $st)
							$value=trim($st->plaintext);
						break;
				endswitch;
				
				$arr[]=$value;
			endforeach;
			
			$race_results[]=$arr;
		endforeach;

		// remove unused fields from headers //
		foreach ($headers as $key => $header) :
			if (in_array($header, $fields_to_ignore)) :
				unset($headers[$key]);
			elseif ($header=='rnk') :
				$headers[$key]='rank';
			elseif ($header=='uci') :
				$headers[$key]='uci_points';
			endif;
		endforeach;

		$headers=array_values($headers);

		// remove unused fields from results //
		foreach ($race_results as $k => $race_result) :
			foreach ($race_result as $key => $value) :
				if (in_array($key, $keys_to_skip))
					unset($race_result[$key]);
			endforeach;
			
			$race_results[$k]=array_values($race_result);
		endforeach;
		
echo '<pre>';
print_r($headers);
print_r($race_results);
echo '</pre>';		
	}
	
}
	
?>