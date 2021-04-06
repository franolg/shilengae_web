<?php 
/**
 * 
 */
class LocalView extends Localization {
	private $lang;
	private $id;
	function __construct($id) {
		$this->id = $id;
		$this->lang = $this->GetLanguage($id);
	}


	function tr($txt) {
		if ($this->lang == 'en') {
			$json = file_get_contents(LOCAL);
			$langs = json_decode($json, true);
			$lang = $langs[$this->lang];
			return @$lang[$txt] ? : "Unknown";
		}else {
			$json = file_get_contents(LOCAL);
			$langs = json_decode($json, true);
			$lang = $langs[$this->lang];
			return @$lang[$txt] ? : "ማይታውቅ ቃል";
		}
	}

	function lang() {
		return $this->lang;
	}

	function changelan() {
		return $this->Change($this->id);
	}
	

}
 ?>