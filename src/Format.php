<?php


namespace CoreWine\Youtube;

class Format{

	protected $tag;
	protected $quality;
	protected $type;
	protected $url;

	public function __construct($raw){

		parse_str($raw,$format);

		if(!isset($format['sig']))
			$format['sig'] = '';

		if(isset($format['quality_label']))
			$this -> quality = $format['quality_label'];

		$this -> type = explode(';',$format['type'])[0];
		$this -> source = explode("/",$this -> type)[0];
		$this -> url =  urldecode($format['url']) . '&signature=' . $format['sig'];
	}

	public function getTag(){
		return $this -> tag;
	}
	
	public function getQuality(){
		return $this -> quality;
	}

	public function getType(){
		return $this -> type;
	}

	public function getUrl(){
		return $this -> url;
	}

	/**
	 * Return if a format is better than this
	 *
	 * @param Format $format
	 *
	 * @return bool
	 */
	public function isBetter($format){
		if(!$this -> quality)
			return false;

		$quality = ["144p","360p","480p","720p","1080p","1440p","2160p"];

		return array_search($this -> quality,$quality) >= array_search($this -> format,$quality);

		return true;
	}

	public function isVideo(){
		return $this -> source == 'video';
	}

	public function isAudio(){
		return $this -> source == 'audio';
	}

	public function isQualityLessThan($q){
		$q = str_replace("p","",$q);
		$q1 = str_replace("p","",$this -> getQuality());
		return $q1 <= $q;
	}
}

?>