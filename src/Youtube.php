<?php


namespace CoreWine\Youtube;

class Youtube{

	/**
	 * Return information about a video
	 *
	 * @param string $id
	 *
	 * @return Info
	 */
	public static function video($id){
		return Video::request($id);
	}
	
}

?>