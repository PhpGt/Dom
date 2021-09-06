<?php
namespace Gt\Dom;

use Gt\Dom\HTMLElement\HTMLElement;
use Gt\Dom\HTMLElement\HTMLInputElement;

/**
 * @property string $value If the underlying element collection contains radio buttons, the RadioNodeList.value property represents the checked radio button. On retrieving the value property, the value of the currently checked radio button is returned as a string. If the collection does not contain any radio buttons or none of the radio buttons in the collection is in checked state, the empty string is returned. On setting the value property, the first radio button input element whose value property is equal to the new value will be set to checked.
 */
class RadioNodeList extends NodeList {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/RadioNodeList/value */
	public function __prop_get_value():?string {
		foreach($this as $node) {
			/** @var HTMLInputElement $node */
			if($node->checked) {
				return $node->value;
			}
		}

		return null;
	}
}
