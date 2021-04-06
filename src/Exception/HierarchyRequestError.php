<?php

namespace Gt\Dom\Exception;

/**
 * @property-read string $name
 */
class HierarchyRequestError extends DOMException {
	protected string $name = "HierarchyRequestError";
}