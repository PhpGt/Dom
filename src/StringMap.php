<?php
namespace Gt\Dom;

use ArrayAccess;

class StringMap implements ArrayAccess {
	/** @var Element */
	protected $ownerElement;
	/** @var array */
	protected $properties;

	/**
	 * @param Attr[] $attributes
	 */
	public function __construct(
		Element $ownerElement,
		$attributes,
		string $prefix = "data-"
	) {
		$this->ownerElement = $ownerElement;
		$this->properties = [];

		foreach($attributes as $attr) {
			if(strpos($attr->name, $prefix) !== 0) {
				continue;
			}

			$propName = $this->getPropertyName($attr);
			$this->properties[$propName] = $attr->value;
		}
	}

	public function __isset(string $name):bool {
		return isset($this->properties[$name]);
	}

	public function __unset(string $name):void {
		unset($this->properties[$name]);
		$this->updateOwnerElement();
	}

	public function __get(string $name):?string {
		return $this->properties[$name] ?? null;
	}

	public function __set(string $name, string $value):void {
		$this->properties[$name] = $value;
		$this->updateOwnerElement();
	}

	protected function updateOwnerElement():void {
		foreach($this->properties as $key => $value) {
			$this->ownerElement->setAttribute(
				$this->getAttributeName($key),
				$value
			);
		}
	}

	protected function getPropertyName(Attr $attr):string {
		$name = "";
		$nameParts = explode("-", $attr->name);

		foreach($nameParts as $i => $part) {
			if($i === 0) {
				continue;
			}

			if($i > 1) {
				$part = ucfirst($part);
			}

			$name .= $part;
		}

		return $name;
	}

	protected function getAttributeName(string $propName):string {
		$nameParts = preg_split(
			"/(?=[A-Z])/",
			$propName
		);
		array_unshift($nameParts, "data");
		$nameParts = array_map("strtolower", $nameParts);
		return implode("-", $nameParts);
	}

	/**
	 * @link https://php.net/manual/en/arrayaccess.offsetexists.php
	 */
	public function offsetExists($offset):bool {
		return $this->__isset($offset);
	}

	/**
	 * @link https://php.net/manual/en/arrayaccess.offsetget.php
	 */
	public function offsetGet($offset):?string {
		return $this->__get($offset);
	}

	/**
	 * @link https://php.net/manual/en/arrayaccess.offsetset.php
	 */
	public function offsetSet($offset, $value):void {
		$this->__set($offset, $value);
	}

	/**
	 * @link https://php.net/manual/en/arrayaccess.offsetunset.php
	 */
	public function offsetUnset($offset):void {
		$this->__unset($offset);
	}
}