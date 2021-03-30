<?php

/**
 * 
 */
class AppController extends Platform {
	public function AddTerm($term,$lang="EN") {
		return $this->Add($term,$lang);
	}

	public function EditTerm($term,$flag,$lang = "EN") {
		return $this->Edit($term,$flag,$lang);
	}
}