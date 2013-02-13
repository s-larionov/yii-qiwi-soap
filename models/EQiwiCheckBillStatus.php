<?php

class EQiwiCheckBillRequest {
	/** @var string */
	public $login;
	/** @var string */
	public $password;
	/** @var string */
	public $txn;

	/**
	 * @param string $login       Логин (id) магазина
	 * @param string $password    Пароль для магазина
	 * @param string $txn         Уникальный идентификатор счета (максимальная длина 30 байт)
	 */
	function __construct($login, $password, $txn) {
		$this->login    = $login;
		$this->password = $password;
		$this->txn      = $txn;
	}
}
