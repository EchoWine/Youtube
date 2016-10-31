<?php


namespace CoreWine\Youtube;

class Video{

	/**
	 * List of all formats
	 *
	 * @var array
	 */
	protected $formats = [];

	/**
	 * Make a request to obtain info about a video
	 *
	 * @param string $id
	 *
	 * @return self
	 */
	public static function request($id){

		$url = 'http://www.youtube.com/get_video_info?&video_id='. $id.''; //video details fix *1
		$content = file_get_contents($url);



		if(!$content){
			throw new \Exception("Cannot get info about video");
		}

		return new self($content);
	}

	/**
	 * Construct the info object
	 *
	 * @param string $raw
	 */
	public function __construct($raw){
		parse_str($raw,$params);

		$formats_raw = explode(',',$params['adaptive_fmts']);

		foreach($formats_raw as $format_raw) {

			$formats[] = new Format($format_raw);
		}

		$this -> formats = $formats;
	}

	/**
	 * Return array formats
	 *
	 * @return array
	 */
	public function getFormats(){
		return $this -> formats;
	}

	/**
	 * Return best quality video url
	 *
	 * @return string
	 */
	public function getBestQualityUrl(){
		$best = null;

		foreach($this -> formats as $format){
			if($format -> isVideo() && !$best || $best -> isBetter($format)){
				$best = $format;
			}
		}

		return $best ? $best -> getUrl() : null;
	}
	
	/**
	 * Return all formats video
	 *
	 * @return array
	 */
	public function getFormatsVideo(){
		$return = [];

		foreach($this -> formats as $format){
			if($format -> isVideo()){
				$return[] = $format;
			}
		}

		return $return;

	}

	/**
	 * Return all formats audio
	 *
	 * @return array
	 */
	public function getFormatsAudio(){
		$return = [];

		foreach($this -> formats as $format){
			if($format -> isAudio()){
				$return[] = $format;
			}
		}

		return $return;

	}

	/**
	 * Return format with quality closer to
	 *
	 * @param quality
	 *
	 * @return Format
	 */
	public function getVideoCloserTo($quality){
		foreach($this -> getFormatsVideo() as $format){
			if($format -> isQualityLessThan($quality))
				return $format;
		}

		return null;
	}
}

?>