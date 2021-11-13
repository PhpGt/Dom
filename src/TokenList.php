<?php
namespace Gt\Dom;

/**
 * Represents a set of space-separated tokens. Such a set is returned by
 * Element::$classList, HTMLLinkElement::$relList, HTMLAnchorElement::$relList
 * or HTMLAreaElement::$relList.
 *
 * It is indexed beginning with 0 as with arrays.
 *
 * DOMTokenList is always case-sensitive.
 * @property-read int $length
 */
class TokenList {
	use LiveProperty;

	private $element;
	private $attributeName;
	private $tokenArray;

	public function __construct(Element $element, string $attributeName) {
		$this->element = $element;
		$this->attributeName = $attributeName;
	}

	/**
	 * Tokenises the internal element's named attribute to $this->tokenArray.
	 */
	private function tok():void {
		$attributeValue = $this->element->getAttribute($this->attributeName);
		$this->tokenArray = array_filter(
			explode(" ", $attributeValue ?? "")
		);
	}

	/**
	 * Untokenises $this->tokenArray to the internal element's named attribute.
	 */
	private function untok():void {
		$attributeValue = implode(" ", $this->tokenArray);
		$this->element->setAttribute($this->attributeName, trim($attributeValue));
	}

	protected function prop_get_length() {
		$this->tok();

		return count($this->tokenArray);
	}

	/**
	 * Returns an item in the list by its index (or null if the number is
	 * greater than or equal to the length of the list).
	 * @param int $index
	 * @return string|null
	 */
	public function item(int $index) {
		$this->tok();

		return $this->tokenArray[$index] ?? null;
	}

	/**
	 * Returns true if the underlying string contains $token, otherwise false.
	 * @param string $token
	 * @return bool
	 */
	public function contains(string $token) {
		$this->tok();

		return in_array($token, $this->tokenArray);
	}

	/**
	 * Adds $token to the underlying attribute value.
	 * @param string $token
	 * @return void
	 */
	public function add(string $token):void {
		if($this->contains($token)) {
			return;
		}

		$this->tokenArray [] = $token;

		$this->untok();
	}

	/**
	 * Removes $token from the underlying attribute value.
	 * @param string $token
	 * @return null
	 */
	public function remove(string $token):void {
		if(!$this->contains($token)) {
			return;
		}

		$index = array_search($token, $this->tokenArray);

		unset($this->tokenArray[$index]);
		$this->untok();
	}

	/**
	 * Removes $token from the underlying attribute value and returns false. If
	 * $token doesn't exist, it's added and the function returns true.
	 * @param string $token
	 * @return bool true if token is added, false if token is removed.
	 */
	public function toggle(string $token):bool {
		if($this->contains($token)) {
			$this->remove($token);

			return false;
		}

		$this->add($token);

		return true;
	}

	public function __toString() {
		return join(" ", $this->tokenArray);
	}
}
