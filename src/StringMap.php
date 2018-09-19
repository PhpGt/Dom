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

	public function __get(string $name):?string {
		return $this->properties[$name] ?? null;
	}

	public function __set(string $name, string $value):void {
		$this->properties[$name] = $value;

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
		return implode("-", $nameParts);
	}

	/**
	 * Whether a offset exists
	 * @link https://php.net/manual/en/arrayaccess.offsetexists.php
	 * @param mixed $offset <p>
	 * An offset to check for.
	 * </p>
	 * @return boolean true on success or false on failure.
	 * </p>
	 * <p>
	 * The return value will be casted to boolean if non-boolean was returned.
	 * @since 5.0.0
	 */
	public function offsetExists($offset) {
		// TODO: Implement offsetExists() method.
	}

	/**
	 * Offset to retrieve
	 * @link https://php.net/manual/en/arrayaccess.offsetget.php
	 * @param mixed $offset <p>
	 * The offset to retrieve.
	 * </p>
	 * @return mixed Can return all value types.
	 * @since 5.0.0
	 */
	public function offsetGet($offset) {
		// TODO: Implement offsetGet() method.
	}

	/**
	 * Offset to set
	 * @link https://php.net/manual/en/arrayaccess.offsetset.php
	 * @param mixed $offset <p>
	 * The offset to assign the value to.
	 * </p>
	 * @param mixed $value <p>
	 * The value to set.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetSet($offset, $value) {
		// TODO: Implement offsetSet() method.
	}

	/**
	 * Offset to unset
	 * @link https://php.net/manual/en/arrayaccess.offsetunset.php
	 * @param mixed $offset <p>
	 * The offset to unset.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetUnset($offset) {
		// TODO: Implement offsetUnset() method.
	}
}