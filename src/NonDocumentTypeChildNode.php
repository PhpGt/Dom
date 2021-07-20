<?php
namespace Gt\Dom;

/**
 * The NonDocumentTypeChildNode interface contains methods that are particular
 * to Node objects that can have a parent, but not suitable for DocumentType.
 *
 * NonDocumentTypeChildNode is a raw interface and no object of this type can
 * be created; it is implemented by Element, and CharacterData objects.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/NonDocumentTypeChildNode
 * @link https://dom.spec.whatwg.org/#interface-nondocumenttypechildnode
 *
 * @property-read ?Element $nextElementSibling Is an Element, the element immediately following the given one in the tree, or null if there's no sibling node.
 * @property-read ?Element $previousElementSibling Is a Element, the element immediately preceding the given one in the tree, or null if there is no sibling element.
 */
trait NonDocumentTypeChildNode {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/NonDocumentTypeChildNode/nextElementSibling */
	protected function __prop_get_nextElementSibling():?Element {
		$context = $this;
		while($context = $context->nextSibling) {
			if($context instanceof Element) {
				return $context;
			}
		}

		return null;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/NonDocumentTypeChildNode/previousElementSibling */
	protected function __prop_get_previousElementSibling():?Element {
		$context = $this;
		while($context = $context->previousSibling) {
			if($context instanceof Element) {
				return $context;
			}
		}

		return null;
	}
}
