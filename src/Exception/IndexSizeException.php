<?php

namespace Gt\Dom\Exception;

/**
 * @property-read string $name
 */
class IndexSizeException extends DOMException {
	protected string $name = "IndexSizeError";
}
