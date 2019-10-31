<?php
namespace Gt\Dom;

/**
 * Contains methods that are particular to Node objects that can have a parent,
 * but not suitable for DocumentType.
 *
 * This trait can only be used in a class that is a trait of LiveProperty.
 *
 * This trait is used by the following classes:
 *  - Element
 *  - CharacterData
 * @property-read Element|null $previousElementSibling The Element immediately
 *  prior to this Node in its parent's $children list, or null if there is no
 *  Element in the list prior to this Node.
 * @property-read Element|null $nextElementSibling The Element immediately
 *  following this Node in its parent's children list, or null if there is no
 *  Element in the list following this node.
 */
trait NonDocumentTypeChildNode {
	protected function prop_get_previousElementSibling() {
		$element = $this;

		while($element) {
			$element = $element->previousSibling;

			if($element instanceof Element) {
				return $element;
			}
		}

		return null;
	}

	protected function prop_get_nextElementSibling() {
		$element = $this;

		while($element) {
			$element = $element->nextSibling;

			if($element instanceof Element) {
				return $element;
			}
		}

		return null;
	}
}