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
	public function Addprp($term,$lang="EN") {
		return $this->AddPP($term,$lang);
	}

	public function Editprp($term,$flag,$lang = "EN") {
		return $this->EditPP($term,$flag,$lang);
	}
}