<?php

class EQiwiCreateBillRequest {
	const ALARM_NONE  = 0;
	const ALARM_SMS   = 1;
	const ALARM_PHONE = 2;

	/** @var string */
	public $login;
	/** @var string */
	public $password;
	/** @var string */
	public $user;
	/** @var string */
	public $amount;
	/** @var string */
	public $comment;
	/** @var string */
	public $txn;
	/** @var string */
	public $lifetime;
	/** @var int */
	public $alarm = self::ALARM_SMS;
	/** @var boolean */
	public $create;

	/**
	 * @param string $login       Логин (id) магазина
	 * @param string $password    Пароль для магазина
	 *
	 * @param string $user        Идентификатор пользователя (номер телефона)
	 * @param string $amount      Сумма, на которую выставляется счет (разделитель - точка ".")
	 * @param string $comment     Комментарий к счету, который увидит пользователь (максимальная длина 255 байт)
	 * @param string $lifetime    Время действия счета (в формате dd.MM.yyyy HH:mm:ss)
	 * @param string $txn         Уникальный идентификатор счета (максимальная длина 30 байт)
	 * @param int $alarm          Уведомления доступны только магазинам, зарегистрированным по схеме "Именной кошелек"
	 *                            Для магазинов, зарегистрированных по схеме "Прием платежей", уведомления заблокированы
	 * @param boolean $create     Флаг для создания нового пользователя (если он не зарегистрирован в системе)
	 */
	function __construct($login, $password, $user, $amount, $txn, $comment, $lifetime = null, $alarm = self::ALARM_SMS, $create = true) {
		$this->alarm    = $alarm;
		$this->amount   = number_format($amount, 2, '.', '');
		$this->comment  = $comment;
		$this->create   = $create;
		$this->lifetime = $lifetime;
		$this->login    = $login;
		$this->password = $password;
		$this->txn      = $txn;
		$this->user     = $user;
	}
}
