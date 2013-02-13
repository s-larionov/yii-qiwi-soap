<?php

class EQiwiHelper {
	const RESPONSE_SUCCESS                   = 0;
	const RESPONSE_SERVER_BUSY               = 13;
	const RESPONSE_AUTH_FAILED               = 150;
	const RESPONSE_BILL_NOT_FOUND            = 210;
	const RESPONSE_BILL_ALREADY_EXIST        = 215;
	const RESPONSE_AMOUNT_IS_TOO_SMALL       = 241;
	const RESPONSE_AMOUNT_IS_TOO_LARGE       = 242;
	const RESPONSE_INVALID_DATE_RANGE        = 278;
	const RESPONSE_UNKNOWN_AGENT             = 298;
	const RESPONSE_UNKNOWN_ERROR             = 300;
	const RESPONSE_ENCRYPTION_ERROR          = 330;
	const RESPONSE_LIMIT_CONCURRENT_REQUESTS = 370;

	private static $responseMessages = array(
		self::RESPONSE_SUCCESS                   => 'Успех',
		self::RESPONSE_SERVER_BUSY               => 'Сервер занят, повторите запрос позже',
		self::RESPONSE_AUTH_FAILED               => 'Ошибка авторизации (неверный логин/пароль)',
		self::RESPONSE_BILL_NOT_FOUND            => 'Счет не найден',
		self::RESPONSE_BILL_ALREADY_EXIST        => 'Счет с таким txn-id уже существует',
		self::RESPONSE_AMOUNT_IS_TOO_SMALL       => 'Сумма слишком мала',
		self::RESPONSE_AMOUNT_IS_TOO_LARGE       => 'Превышена максимальная сумма платежа – 15 000 рублей',
		self::RESPONSE_INVALID_DATE_RANGE        => 'Превышение максимального интервала получения списка счетов',
		self::RESPONSE_UNKNOWN_AGENT             => 'Агента не существует в системе',
		self::RESPONSE_UNKNOWN_ERROR             => 'Неизвестная ошибка',
		self::RESPONSE_ENCRYPTION_ERROR          => 'Ошибка шифрования',
		self::RESPONSE_LIMIT_CONCURRENT_REQUESTS => 'Превышено максимальное кол-во одновременно выполняемых запросов',
	);

	/**
	 * @param int $code
	 * @return string
	 */
	public static function getResponseMesssageByCode($code) {
		if (array_key_exists($code, self::$responseMessages)) {
			return self::$responseMessages[$code];
		}
		return "Unknown response status {$code}";
	}

	/**
	 * @param int $code
	 * @return bool
	 */
	public static function isSuccessResponse($code) {
		return $code === self::RESPONSE_SUCCESS;
	}
}
