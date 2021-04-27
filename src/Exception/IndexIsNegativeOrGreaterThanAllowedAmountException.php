<?php
namespace Gt\Dom\Exception;

use Throwable;

class IndexIsNegativeOrGreaterThanAllowedAmountException extends DOMException {
	/**
	 * @param string $message
	 * @param int $code
	 * @param Throwable|null $previous
	 */
	public function __construct(
		$message = "",
		$code = 0,
		Throwable $previous = null
	) {
		$newMessage = "Index or size is negative or greater than the allowed amount";
		if(strlen($message) > 0) {
			$newMessage .= ": $message";
		}
		parent::__construct($newMessage, $code, $previous);
	}
}
