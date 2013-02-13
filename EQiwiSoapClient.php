<?php

Yii::setPathOfAlias('qiwi-soap', __DIR__);
Yii::import('qiwi-soap.*');
Yii::import('qiwi-soap.models.*');

class EQiwiSoapClient extends SoapClient {
	private static $classMap = array(
		'checkBill'           => 'EQiwiCheckBillRequest',
		'checkBillResponse'   => 'EQiwiBillStatus',
		'getBillList'         => 'EQiwiBillListRequest',
		'getBillListResponse' => 'EQiwiBillList',
		'cancelBill'          => 'EQiwiCancelBillRequest',
		'cancelBillResponse'  => 'EQiwiCancelBillResponse',
		'createBill'          => 'EQiwiCreateBillRequest',
		'createBillResponse'  => 'EQiwiCreateBillResponse',
	);

	/**
	 * @param array $options
	 */
	public function __construct(array $options = array()) {
		foreach (self::$classMap as $key => $value) {
			if (!isset($options['classmap'][$key])) {
				$options['classmap'][$key] = $value;
			}
		}
		$options['trace'] = 1;
		parent::__construct($this->getWsdlUrl(), $options);
	}

	/**
	 * @param \EQiwiCheckBillRequest $request
	 * @return EQiwiBill
	 */
	public function checkBill(EQiwiCheckBillRequest $request) {
		$response = $this->__soapCall('checkBill', array($request), array(
				'uri'        => 'http://server.ishop.mw.ru/',
				'soapaction' => ''
			)
		);
		$this->logRequest();
		return $response;
	}

	protected function logRequest() {
		Yii::log("Soap request:\n{$this->__getLastRequest()}", CLogger::LEVEL_TRACE, 'soap');
		Yii::log("Soap response:\n{$this->__getLastResponse()}", CLogger::LEVEL_TRACE, 'soap');
	}

	/**
	 * @param EQiwiBillListRequest $request
	 * @return EQiwiBillList
	 */
	public function getBillList(EQiwiBillListRequest $request) {
		$response = $this->__soapCall('getBillList', array($request), array(
				'uri'        => 'http://server.ishop.mw.ru/',
				'soapaction' => ''
			)
		);
		$this->logRequest();
		return $response;
	}

	/**
	 * @param EQiwiCancelBillRequest $request
	 * @return bool
	 * @throws EQiwiSoapException
	 */
	public function cancelBill(EQiwiCancelBillRequest $request) {
		/** @var $response EQiwiCancelBillResponse */
		$response = $this->__soapCall('cancelBill', array($request), array(
				'uri'        => 'http://server.ishop.mw.ru/',
				'soapaction' => ''
			)
		);
		$this->logRequest();

		if (!EQiwiHelper::isSuccessResponse($response->cancelBillResult)) {
			throw new EQiwiSoapException(EQiwiHelper::getResponseMesssageByCode($response->cancelBillResult), $response->cancelBillResult);
		}

		return true;
	}

	/**
	 * @param EQiwiCreateBillRequest $request
	 * @return bool
	 * @throws EQiwiSoapException
	 */
	public function createBill(EQiwiCreateBillRequest $request) {
		/** @var $response EQiwiCreateBillResponse */
		$response = $this->__soapCall('createBill', array($request), array(
				'uri'        => 'http://server.ishop.mw.ru/',
				'soapaction' => ''
			)
		);
		$this->logRequest();

		if (!EQiwiHelper::isSuccessResponse($response->createBillResult)) {
			throw new EQiwiSoapException(EQiwiHelper::getResponseMesssageByCode($response->createBillResult), $response->createBillResult);
		}

		return true;
	}

	protected function getWsdlUrl() {
		return
			Yii::app()->request->hostInfo .
			Yii::app()->assetManager->publish(Yii::getPathOfAlias('qiwi-soap.wsdl') . '/IShopServerWS.wsdl');
	}
}
