<?php
namespace Gt\Dom;

/**
 * Calls prop_* methods to provide live properties through the
 * __get and __set magic methods.
 *
 * If the class with this trait has its own __get method, for compatibility
 * it should call the __get_live method after its own processing.
 */
trait LiveProperty {
	public function __get($name) {
		return self::__get_live($name);
	}

	public function __set($name, $value) {
		return self::__set_live($name, $value);
	}

	private function __get_live($name) {
		$methodName = "prop_get_$name";
		if(method_exists($this, $methodName)) {
			return $this->$methodName();
		}
	}

	private function __set_live($name, $value) {
		$methodName = "prop_set_$name";
		if(method_exists($this, $methodName)) {
			return $this->$methodName($value);
		}
	}
}