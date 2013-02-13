<?php

class EQiwiBillListRequest {
	/** @var string */
	public $login;
	/** @var string */
	public $password;
	/** @var string */
	public $dateFrom;
	/** @var string */
	public $dateTo;
	/** @var int */
	public $status;

	/**
	 * @param string $login       Логин (id) магазина
	 * @param string $password    Пароль для магазина
	 * @param string $dateFrom    Дата начала периода
	 * @param string $dateTo      Дата окончания периода
	 * @param int $status         Статус счетов (Для получения счетов всех статусов указать "0")
	 */
	function __construct($login, $password, $dateFrom, $dateTo, $status = EQiwiBill::STATUS_ALL) {
		$this->dateFrom = $dateFrom;
		$this->dateTo   = $dateTo;
		$this->login    = $login;
		$this->password = $password;
		$this->status   = $status;
	}
}
