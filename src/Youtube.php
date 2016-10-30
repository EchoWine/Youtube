<?php


namespace CoreWine\Youtube;

class Youtube{

	public static function download($id,$destination){
		$url = 'http://www.youtube.com/get_video_info?&video_id='. $my_id.'&asv=3&el=detailpage&hl=en_US'; //video details fix *1
		$params = file_get_contents($url);

		print_r($params);
	}
	
}

?>