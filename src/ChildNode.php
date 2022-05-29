<?php
namespace Gt\Dom;

/**
 * The ChildNode mixin contains methods and properties that are common to all
 * types of Node objects that can have a parent. It's implemented by Element,
 * DocumentType, and CharacterData objects.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode
 *
 * @property-read null|Element $parentElement
 * @property-read null|Node|Element $parentNode
 */
trait ChildNode {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/parentElement */
	protected function __prop_get_parentElement():null|Element {
		$element = $this->parentNode;
		if($element instanceof Element) {
			return $element;
		}

		return null;
	}

	/**
	 * Removes the object from the tree it belongs to.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/remove
	 */
	public function remove():void {
		if($parentNode = $this->parentNode) {
			$parentNode->removeChild($this);
		}
	}

	/** @param Element|Node|string...$nodes */
	public function before(...$nodes):void {
		$parent = $this->parentElement;
		if(!$parent) {
			return;
		}

		foreach($nodes as $node) {
			if(is_string($node)) {
				$node = $this->ownerDocument->createTextNode($node);
			}
			$parent->insertBefore($node, $this);
		}
	}

	/** @param Element|Node|string...$nodes */
	public function after(...$nodes):void {
		$parent = $this->parentElement;
		$nextSibling = $this->nextSibling;
		if(!$parent) {
			return;
		}

		foreach($nodes as $node) {
			if(is_string($node)) {
				$node = $this->ownerDocument->createTextNode($node);
			}
			$parent->insertBefore($node, $nextSibling);
		}
	}

	/** @param Node|Element|string Node|Element|string */
	public function replaceWith(...$nodes):void {
		$parent = $this->parentElement;
		if(!$parent) {
			return;
		}

		$fragment = $this->ownerDocument->createDocumentFragment();
		foreach($nodes as $node) {
			if(is_string($node)) {
				$node = $this->ownerDocument->createTextNode($node);
			}
			$fragment->appendChild($node);
		}

		$parent->replaceChild($fragment, $this);
	}
}
