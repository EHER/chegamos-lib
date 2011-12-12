<?php

namespace app\models;

class DealList extends ItemsList {

	var $currentPage = 0;

	public function __construct($data = null) {
		if (!empty($data)) {
			foreach ($data->deals as $deal) {
				$this->add(New Deal($deal->deal));
			}
		}
	}

	public function setCurrentPage($currentPage) {
		$this->currentPage = $currentPage;
	}

	public function getCurrentPage() {
		return $this->currentPage;
	}
}
