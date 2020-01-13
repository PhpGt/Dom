<?php
namespace Gt\Dom;

/**
 * Calls prop_* methods to provide live properties through the
 * __get and __set magic methods.
 *
 * If the class with this trait has its own __get method, for compatibility
 * it should call the __get_live method after its own processing.
 *
 * @property-read Document $ownerDocument
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

		if(isset(PropertyAttribute::PROPERTY_ATTRIBUTE_MAP[$name])) {
			$attribute = PropertyAttribute::PROPERTY_ATTRIBUTE_MAP[$name];
			if($attribute === true) {
				return $this->hasAttribute($name);
			}

			return $this->getAttribute($name);
		}
	}

	private function __set_live($name, $value) {
		$methodName = "prop_set_$name";
		if(method_exists($this, $methodName)) {
			return $this->$methodName($value);
		}

		if(isset(PropertyAttribute::PROPERTY_ATTRIBUTE_MAP[$name])) {
			$attribute = PropertyAttribute::PROPERTY_ATTRIBUTE_MAP[$name];
			if($attribute === true) {
				$newAttr = $this->ownerDocument->createAttribute($name);

				if($value) {
					$this->setAttributeNode($newAttr);
				}
				else {
					$this->removeAttribute($name);
				}
			}
			else {
				$this->setAttribute($attribute, $value);
			}
		}

		return null;
	}
}