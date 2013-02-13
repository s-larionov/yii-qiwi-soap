<?php

Yii::setPathOfAlias('qiwi-soap', __DIR__);

Yii::import('qiwi-soap.EIQiwiSoapHandler');
Yii::import('qiwi-soap.models.*');

class EQiwiSoapServer extends SoapServer {

	private static $classMap = array(
		'tns:updateBill'         => 'EQiwiInUpdateBillRequest',
		'tns:updateBillResponse' => 'EQiwiInUpdateBillResponse',
	);

	function __construct($handlerClass, array $options = array()) {
		if (!class_exists($handlerClass)) {
			throw new QiwiSoapServerError("Class {$handlerClass} doesn't exists");
		}
		if (!is_subclass_of($handlerClass, 'EIQiwiSoapHandler')) {
			throw new QiwiSoapServerError("Class {$handlerClass} must implement IQiwiSoapHandler");
		}

		foreach (self::$classMap as $key => $value) {
			if (!isset($options['classmap'][$key])) {
				$options['classmap'][$key] = $value;
			}
		}
		$options['trace'] = 1;
		parent::SoapServer($this->getWsdlUrl(), $options);

		$this->setClass($handlerClass);
	}

	protected function getWsdlUrl() {
		return
			Yii::app()->request->hostInfo .
			Yii::app()->assetManager->publish(Yii::getPathOfAlias('qiwi-soap.wsdl') . '/IShopClientWS.wsdl');
	}
}

class QiwiSoapServerError extends CException {

}
