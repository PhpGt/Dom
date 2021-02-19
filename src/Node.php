<?php
namespace Gt\Dom;

use Gt\PropFunc\MagicProp;

/**
 * The DOM Node interface is an abstract base class upon which many other DOM
 * API objects are based, thus letting those object types to be used similarly
 * and often interchangeably. As an abstract class, there is no such thing as a
 * plain Node object. All objects that implement Node functionality are based
 * on one of its subclasses. Most notable are Document, Element, and
 * DocumentFragment.
 *
 * In addition, every kind of DOM node is represented by an interface based on
 * Node. These include Attr, CharacterData (which Text, Comment, and
 * CDATASection are all based on), ProcessingInstruction, DocumentType,
 * Notation, Entity, and EntityReference.
 *
 * In some cases, a particular feature of the base Node interface may not apply
 * to one of its child interfaces; in that case, the inheriting node may return
 * null or throw an exception, depending on circumstances. For example,
 * attempting to add children to a node type that cannot have children will
 * throw an exception.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node
 *
 * @property-read string $baseURI Returns a DOMString representing the base URL of the document containing the Node
 * @property-read NodeList $childNodes Returns a live NodeList containing all the children of this node (including elements, text and comments). NodeList being live means that if the children of the Node change, the NodeList object is automatically updated.
 * @property-read ?Node $firstChild Returns a Node representing the first direct child node of the node, or null if the node has no child.
 * @property-read bool $isConnected A boolean indicating whether or not the Node is connected (directly or indirectly) to the Document object.
 * @property-read ?Node $lastChild Returns a Node representing the last direct child node of the node, or null if the node has no child.
 * @property-read ?Node $nextSibling Returns a Node representing the next node in the tree, or null if there isn't such node.
 * @property-read string $nodeName Returns a DOMString containing the name of the Node. The structure of the name will differ with the node type. E.g. An HTMLElement will contain the name of the corresponding tag, like 'audio' for an HTMLAudioElement, a Text node will have the '#text' string, or a Document node will have the '#document' string.
 * @property-read int $nodeType Returns an unsigned short representing the type of the node.
 * @property string $nodeValue Returns / Sets the value of the current node.
 * @property-read ?Document $ownerDocument Returns the Document that this node belongs to. If the node is itself a document, returns null.
 * @property-read ?Node $parentNode Returns a Node that is the parent of this node. If there is no such node, like if this node is the top of the tree or if doesn't participate in a tree, this property returns null.
 * @property-read ?Element $parentElement Returns an Element that is the parent of this node. If the node has no parent, or if that parent is not an Element, this property returns null.
 * @property-read ?Node $previousSibling Returns a Node representing the previous node in the tree, or null if there isn't such node.
 * @property string $textContent Returns / Sets the textual content of an element and all its descendants.
 */
class Node {
	use MagicProp;

	protected function __prop_get_baseURI():string {

	}

	protected function __prop_get_childNodes():NodeList {

	}

	protected function __prop_get_firstChild():?Node {

	}

	protected function __prop_get_isConnected():bool {

	}

	protected function __prop_get_lastChild():?Node {

	}

	protected function __prop_get_nextSibling():?Node {

	}

	protected function __prop_get_nodeName():string {

	}

	protected function __prop_get_nodeType():int {

	}

	protected function __prop_get_nodeValue():string {

	}

	protected function __prop_set_nodeValue(string $value):void {

	}

	protected function __prop_get_ownerDocument():?Document {

	}

	protected function __prop_get_parentNode():?Node {

	}

	protected function __prop_get_parentElement():?Node {

	}

	protected function __prop_get_previousSibling():?Node {

	}

	protected function __prop_get_textContent():string {

	}

	protected function __prop_set_textContent():void {

	}



	/**
	 * Adds the specified childNode argument as the last child to the
	 * current node. If the argument referenced an existing node on the
	 * DOM tree, the node will be detached from its current position and
	 * attached at the new position.
	 *
	 * @param Node $newNode
	 * @return Node
	 * @link
	 */
	public function appendChild(Node $newNode):Node {

	}

	/**
	 * Clone a Node, and optionally, all of its contents. By default, it
	 * clones the content of the node.
	 *
	 * @param bool $deep
	 * @return Node
	 * @link
	 */
	public function cloneNode(bool $deep = false):Node {

	}

	/**
	 * Compares the position of the current node against another node in
	 * any other document.
	 *
	 * @param Node $otherNode
	 * @return int
	 * @link
	 */
	public function compareDocumentPosition(Node $otherNode):int {

	}

	/**
	 * Returns a Boolean value indicating whether or not a node is a
	 * descendant of the calling node.
	 *
	 * @param Node $otherNode
	 * @return bool
	 * @link
	 */
	public function contains(Node $otherNode):bool {

	}

	/**
	 * Returns the context object's root.
	 *
	 * @return Node
	 * @link
	 */
	public function getRootNode():Node {

	}

	/**
	 * Returns a Boolean indicating whether or not the element has any
	 * child nodes.
	 *
	 * @return bool
	 * @link
	 */
	public function hasChildNodes():bool {

	}

	/**
	 * Inserts a Node before the reference node as a child of a
	 * specified parent node.
	 *
	 * @param Node $newNode
	 * @param Node $refNode
	 * @return Node
	 * @link
	 */
	public function insertBefore(Node $newNode, Node $refNode):Node {

	}

	/**
	 * Accepts a namespace URI as an argument and returns a Boolean with a
	 * value of true if the namespace is the default namespace on the given
	 * node or false if not.
	 *
	 * @param string $namespace
	 * @return bool
	 * @link
	 */
	public function isDefaultNamespace(string $namespace):bool {

	}

	/**
	 * Returns a Boolean which indicates whether or not two nodes are of
	 * the same type and all their defining data points match.
	 *
	 * @param Node $otherNode
	 * @return bool
	 * @link
	 */
	public function isEqualNode(Node $otherNode):bool {

	}

	/**
	 * Returns a Boolean value indicating whether or not the two nodes are
	 * the same (that is, they reference the same object).
	 *
	 * @param Node $otherNode
	 * @return bool
	 * @link
	 */
	public function isSameNode(Node $otherNode):bool {

	}

	/**
	 * Returns a DOMString containing the prefix for a given namespace URI,
	 * if present, and null if not. When multiple prefixes are possible,
	 * the result is implementation-dependent.
	 *
	 * @return ?string
	 * @link
	 */
	public function lookupPrefix():?string {

	}

	/**
	 * Accepts a prefix and returns the namespace URI associated with it on
	 * the given node if found (and null if not). Supplying null for the
	 * prefix will return the default namespace.
	 *
	 * @param ?string $prefix
	 * @return ?string
	 * @link
	 */
	public function lookupNamespaceURI(string $prefix = null):?string {

	}

	/**
	 * Clean up all the text nodes under this element (merge adjacent,
	 * remove empty).
	 *
	 * @link
	 */
	public function normalize():void {

	}

	/**
	 * Removes a child node from the current element, which must be a
	 * child of the current node.
	 *
	 * @param Node $oldNode
	 * @return Node
	 * @link
	 */
	public function removeChild(Node $oldNode):Node {

	}

	/**
	 * Replaces one child Node of the current one with the second one given
	 * in parameter.
	 *
	 * @param Node $newNode
	 * @param Node $oldNode
	 * @return Node
	 * @link
	 */
	public function replaceChild(Node $newNode, Node $oldNode):Node {

	}
}
