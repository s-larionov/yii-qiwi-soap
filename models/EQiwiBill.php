<?php

class EQiwiBill {
	const STATUS_ALL                 = 0;
	const STATUS_READY               = 50;
	const STATUS_IN_PROGRESS         = 52;
	const STATUS_PAID                = 60;
	const STATUS_ERROR_              = 150;
	const STATUS_USER_AUTH_ERROR     = 151;
	const STATUS_CANCELED            = 160;
	const STATUS_CANCELED_BY_TIMEOUT = 161;

	/** @var string */
	public $user;
	/** @var string */
	public $amount;
	/** @var string */
	public $date;
	/** @var string */
	public $lifetime;
	/** @var int */
	public $status;
}
