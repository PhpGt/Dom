<?php
namespace Gt\Dom;

/**
 * The ChildNode mixin contains methods and properties that are common to all
 * types of Node objects that can have a parent. It's implemented by Element,
 * DocumentType, and CharacterData objects.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode
 *
 * @property-read ?Element $parentElement
 * @property-read ?Node $parentNode
 *
 * @method void before(Node|Element|string...$nodes) Inserts a set of Node objects or strings in the children list of the Element's parent, just before the Element.
 * @method void after(Node|Element|string...$nodes) Inserts a set of Node objects or strings in the children list of the Element's parent, just after the Element.
 * @method void replaceWith(Node|Element|string...$nodes) Replaces the element in the children list of its parent with a set of Node objects or strings.
 */
trait ChildNode {
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
}
