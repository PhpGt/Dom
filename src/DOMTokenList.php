<?php
namespace Gt\Dom;

use Generator;
use Gt\PropFunc\MagicProp;

/**
 * The DOMTokenList interface represents a set of space-separated tokens. Such
 * a set is returned by Element.classList, HTMLLinkElement.relList,
 * HTMLAnchorElement.relList, HTMLAreaElement.relList,
 * HTMLIframeElement.sandbox, or HTMLOutputElement.htmlFor. It is indexed
 * beginning with 0 as with JavaScript Array objects. DOMTokenList is always
 * case-sensitive.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList
 *
 * @property-read int $length Is an integer representing the number of objects stored in the object.
 * @property string $value A stringifier property that returns the value of the list as a DOMString.
 */
class DOMTokenList {
	use MagicProp;

	/** @var callable Return an indexed array of tokens */
	private $callback;

	protected function __construct(callable $callback) {
		$this->callback = $callback;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/length */
	protected function __prop_get_length():int {

	}

	/** https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/value */
	protected function __prop_get_value():string {

	}

	/** https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/value */
	protected function __prop_set_value(string $value):void {

	}

	/**
	 * The item() method of the DOMTokenList interface returns an item in
	 * the list by its index.
	 *
	 * @param int $index A int representing the index of the item you want
	 * to return.
	 * @return string A DOMString representing the returned item. It returns
	 * null if the number is greater than or equal to the length of the
	 * list.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/item
	 */
	public function item(int $index):string {

	}

	/**
	 * The contains() method of the DOMTokenList interface returns a
	 * Boolean — true if the underlying list contains the given token,
	 * otherwise false.
	 *
	 * @param string $token A DOMString representing the token you want to
	 * check for the existence of in the list.
	 * @return bool A Boolean, which is true if the calling list contains
	 * token, otherwise false.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/contains
	 */
	public function contains(string $token):bool {
		return in_array($token, $this->assoc());
	}

	/**
	 * The add() method of the DOMTokenList interface adds the given token
	 * to the list.
	 *
	 * @param string ...$tokens A DOMString representing the token (or
	 * tokens) to add to the tokenList.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/add
	 */
	public function add(string...$tokens):void {

	}

	/**
	 * The remove() method of the DOMTokenList interface removes the
	 * specified tokens from the list.
	 *
	 * @param string ...$tokens A DOMString representing the token you want
	 * to remove from the list. If the string is not in the list, no error
	 * is thrown, and nothing happens.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/remove
	 */
	public function remove(string...$tokens):void {

	}

	/**
	 * The replace() method of the DOMTokenList interface replaces an
	 * existing token with a new token. If the first token doesn't exist,
	 * replace() returns false immediately, without adding the new token to
	 * the token list.
	 *
	 * @param string $oldToken
	 * @param string $newToken
	 * @return bool A boolean value, which is true if oldToken was
	 * successfully replaced, or false if not.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/replace
	 */
	public function replace(string $oldToken, string $newToken):bool {

	}

	/**
	 * The toggle() method of the DOMTokenList interface removes a given
	 * token from the list and returns false. If token doesn't exist it's
	 * added and the function returns true.
	 *
	 * @param string $token A DOMString representing the token you want to
	 * toggle.
	 * @param ?bool $force A Boolean that, if included, turns the toggle
	 * into a one way-only operation. If set to false, then token will only
	 * be removed, but not added. If set to true, then token will only be
	 * added, but not removed.
	 * @return bool A Boolean indicating whether token is in the list after
	 * the call.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/toggle
	 */
	public function toggle(string $token, bool $force = null):bool {

	}

	/**
	 * The DOMTokenList.entries() method returns an iterator allowing you to
	 * go through all key/value pairs contained in this object. The values
	 * are DOMString objects, each representing a single token.
	 *
	 * @return iterable<string> Each element represents the key and value,
	 * for example: "0,first"
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/entries
	 */
	public function entries():iterable {

	}

	/**
	 * The forEach() method of the DOMTokenList interface calls the callback
	 * given in parameter once for each value pair in the list, in
	 * insertion order.
	 *
	 * @param callable $callback Function to execute for each element,
	 * eventually taking three arguments:
	 * 1) currentValue - The current element being processed in the array.
	 * 2) currentIndex - The index of the current element being processed in
	 * the array.
	 * 3) listObj - The array that forEach() is being applied to.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/forEach
	 */
	public function forEach(callable $callback):void {

	}

	/**
	 * The keys() method of the DOMTokenList interface returns an iterator
	 * allowing to go through all keys contained in this object. The keys
	 * are of type unsigned integer.
	 *
	 * @return iterable<int> Returns an iterator.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/keys
	 */
	public function keys():iterable {
	}

	/**
	 * The values() method of the DOMTokenList interface returns an iterator
	 * allowing developers to go through all values contained in the
	 * DOMTokenList. The individual values are DOMString objects.
	 *
	 * @return iterable
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMTokenList/values
	 */
	public function values():iterable {

	}

	/** @return string[] */
	private function assoc():array {
		return call_user_func($this->callback);
	}
}
