<?php

interface EIQiwiSoapHandler {
	/**
	 * @param \EQiwiInUpdateBillRequest| $request
	 * @return EQiwiInUpdateBillResponse
	 */
	function updateBill(EQiwiInUpdateBillRequest $request);
}
