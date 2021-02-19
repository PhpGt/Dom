<?php
namespace Gt\Dom;

use Gt\PropFunc\MagicProp;

/**
 * A type returned by some APIs which contains a list of DOMString (strings).
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMStringList
 *
 * @property-read int $length Returns the length of the list.
 */
class DOMStringList {
	use MagicProp;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/DOMStringList/length */
	public function __prop_get_length():int {

	}

	/**
	 * Returns the string with index index from strings.
	 *
	 * @param int $index
	 * @return ?string
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMStringList/item
	 */
	public function item(int $index):?string {

	}

	/**
	 * Returns true if strings contains string, and false otherwise.
	 *
	 * @param string $string
	 * @return bool
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMStringList/contains
	 */
	public function contains(string $string):bool {

	}
}
