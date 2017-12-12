<?php
namespace Gt\Dom;

/**
 * Represents a Node list that can only contain Element nodes. Internally,
 * a DOMNodeList is used to store the association to the original list of
 * Nodes. The Iterator interface is used to handle the selection of Nodes
 * that are Elements.
 * @property-read int $length Number of Element nodes in this collection
 */
class HTMLCollection extends NodeList {
	/**
	 * @param string $name Returns the specific Node whose ID or, as a fallback,
	 * name matches the string specified by $name. Matching by name is only done
	 * as a last resort, and only if the referenced element supports the name
	 * attribute.
	 * @return Element|null
	 */
	public function namedItem(string $name) {
		$namedElement = null;

// ENHANCEMENT: Iterating all elements is costly. Room for improvement here?
		foreach($this as $element) {
			if($element->getAttribute("id") === $name) {
				return $element;
			}

			if(is_null($namedElement)
				&& $element->getAttribute("name") === $name) {
				$namedElement = $element;
			}
		}

		return $namedElement;
	}
}