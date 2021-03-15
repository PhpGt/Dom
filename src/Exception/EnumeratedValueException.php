<?php
namespace Gt\Dom\Exception;

use Throwable;

class EnumeratedValueException extends DOMException {
	/**
	 * EnumeratedValueException constructor.
	 * @param string $message
	 * @param int $code
	 * @param Throwable|null $previous
	 */
	public function __construct(
		$message = "",
		$code = 0,
		Throwable $previous = null
	) {
		$message = "An invalid or illegal string was specified: $message";

		parent::__construct(
			$message,
			$code,
			$previous
		);
	}
}
