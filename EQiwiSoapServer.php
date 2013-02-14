<?php

Yii::setPathOfAlias('qiwi-soap', __DIR__);

Yii::import('qiwi-soap.*');
Yii::import('qiwi-soap.models.*');

class EQiwiSoapServer extends SoapServer {

	private static $classMap = array(
		'updateBill'         => 'EQiwiInUpdateBillRequest',
		'updateBillResponse' => 'EQiwiInUpdateBillResponse',
	);

	function __construct($handlerClass, array $options = array()) {
		if (!class_exists($handlerClass)) {
			throw new EQiwiSoapServerException("Class {$handlerClass} doesn't exists");
		}
		if (!is_subclass_of($handlerClass, 'EIQiwiSoapHandler')) {
			throw new EQiwiSoapServerException("Class {$handlerClass} must implement IQiwiSoapHandler");
		}

		foreach (self::$classMap as $key => $value) {
			if (!isset($options['classmap'][$key])) {
				$options['classmap'][$key] = $value;
			}
		}
		parent::SoapServer($this->getWsdlUrl(), $options);

		$this->setClass($handlerClass);
	}

	protected function getWsdlUrl() {
		return
			Yii::app()->request->hostInfo .
			Yii::app()->assetManager->publish(Yii::getPathOfAlias('qiwi-soap.wsdl') . '/IShopClientWS.wsdl');
	}
}
