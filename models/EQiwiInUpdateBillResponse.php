<?php

class EQiwiInUpdateBillResponse {
	/** @var int */
	public $updateBillResult;

	function __construct($updateBillResult) {
		$this->updateBillResult = $updateBillResult;
	}
}
