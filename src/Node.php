<?php
namespace Gt\Dom;

use DOMException as NativeDOMException;
use DOMNode;
use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;
use Gt\Dom\Exception\DOMException;
use Gt\Dom\Exception\TextNodeCanNotBeRootNodeException;
use Gt\Dom\Exception\WrongDocumentErrorException;
use Gt\Dom\Facade\DOMDocumentFacade;
use Gt\Dom\Facade\NodeListFactory;
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
 * @property-read string $baseURI Returns a DOMString representing the base URL
 * of the document containing the Node
 * @property-read NodeList $childNodes Returns a live NodeList containing all
 * the children of this node (including elements, text and comments). NodeList
 * being live means that if the children of the Node change, the NodeList object
 * is automatically updated.
 * @property-read ?Node $firstChild Returns a Node representing the first direct
 * child node of the node, or null if the node has no child.
 * @property-read bool $isConnected A boolean indicating whether or not the Node
 * is connected (directly or indirectly) to the Document object.
 * @property-read ?Node $lastChild Returns a Node representing the last direct
 * child node of the node, or null if the node has no child.
 * @property-read ?Node $nextSibling Returns a Node representing the next node
 * in the tree, or null if there isn't such node.
 * @property-read string $nodeName Returns a DOMString containing the name of
 * the Node. The structure of the name will differ with the node type. E.g. An
 * HTMLElement will contain the name of the corresponding tag, like 'audio' for
 * an HTMLAudioElement, a Text node will have the '#text' string, or a Document
 * node will have the '#document' string.
 * @property-read int $nodeType Returns an unsigned short representing the type
 * of the node.
 * @property string $nodeValue Returns / Sets the value of the current node.
 * @property-read ?Document $ownerDocument Returns the Document that this node
 * belongs to. If the node is itself a document, returns null.
 * @property-read ?Node $parentNode Returns a Node that is the parent of this
 * node. If there is no such node, like if this node is the top of the tree or
 * if doesn't participate in a tree, this property returns null.
 * @property-read ?Element $parentElement Returns an Element that is the parent
 * of this node. If the node has no parent, or if that parent is not an Element,
 * this property returns null.
 * @property-read ?Node $previousSibling Returns a Node representing the
 * previous node in the tree, or null if there isn't such node.
 * @property string $textContent Returns / Sets the textual content of an
 * element and all its descendants.
 */
abstract class Node {
	use MagicProp;

	const TYPE_ELEMENT_NODE = 1;
	const TYPE_ATTRIBUTE_NODE = 2;
	const TYPE_TEXT_NODE = 3;
	const TYPE_CDATA_SECTION_NODE = 4;
	const TYPE_PROCESSING_INSTRUCTION_NODE = 7;
	const TYPE_COMMENT_NODE = 8;
	const TYPE_DOCUMENT_NODE = 9;
	const TYPE_DOCUMENT_TYPE_NODE = 10;
	const TYPE_DOCUMENT_FRAGMENT_NODE = 11;

	/**
	 * @param DOMNode $domNode DOMNode or any extension
	 * @noinspection PhpMissingParamTypeInspection
	 */
	protected function __construct(
		protected $domNode
	) {}

	/**
	 * Adds the specified childNode argument as the last child to the
	 * current node. If the argument referenced an existing node on the
	 * DOM tree, the node will be detached from its current position and
	 * attached at the new position.
	 *
	 * @param Node $aChild The node to append to the given parent node
	 * (commonly an element).
	 * @return Node The returned value is the appended child (aChild),
	 * except when aChild is a DocumentFragment, in which case the empty
	 * DocumentFragment is returned.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/appendChild
	 */
	public function appendChild(Node $aChild):Node {
		if($this instanceof Document) {
			if($this->childElementCount > 0) {
				throw new DOMException("Cannot have more than one Element child of a Document");
			}

			if($aChild instanceof Text) {
				throw new TextNodeCanNotBeRootNodeException("Cannot insert a Text as a child of a Document");
			}
		}

		$nativeDomChild = $aChild->ownerDocument->getNativeDomNode($aChild);
		try {
			$this->domNode->appendChild($nativeDomChild);
		}
		catch(NativeDOMException $exception) {
			if(strstr("Wrong Document Error", $exception->getMessage())) {
				throw new WrongDocumentErrorException();
			}
		}
		return $aChild;
	}

	/**
	 * Clone a Node, and optionally, all of its contents. By default, it
	 * clones the content of the node.
	 *
	 * @param bool $deep If true, then node and its whole subtree—including
	 * text that may be in child Text nodes—is also copied. If false, only
	 * node will be cloned. Any text that node contains is not cloned,
	 * either (since text is contained by one or more child Text nodes).
	 * deep has no effect on empty elements (such as the <img> and <input>
	 * elements).
	 *
	 * @return Node The new node, cloned from node. The newClone has no
	 * parent and is not part of the document, until it is added to another
	 * node that is part of the document (using Node.appendChild() or a
	 * similar method).
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/cloneNode
	 */
	public function cloneNode(bool $deep = false):Node {

	}

	/**
	 * Compares the position of the current node against another node in
	 * any other document.
	 *
	 * @param Node $otherNode The other Node with which to compare the first
	 * node’s document position.
	 * @return int An integer value whose bits represent the otherNode's
	 * relationship to the calling node. More than one bit is set if
	 * multiple scenarios apply. For example, if otherNode is located
	 * earlier in the document and contains the node on which
	 * compareDocumentPosition() was called, then both the
	 * DOCUMENT_POSITION_CONTAINS and DOCUMENT_POSITION_PRECEDING bits would
	 * be set, producing a value of 10 (0x0A).
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/compareDocumentPosition
	 */
	public function compareDocumentPosition(Node $otherNode):int {

	}

	/**
	 * Returns a Boolean value indicating whether or not a node is a
	 * descendant of the calling node.
	 *
	 * @param Node $otherNode
	 * @return bool
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/contains
	 */
	public function contains(Node $otherNode):bool {

	}

	/**
	 * Returns the context object's root.
	 *
	 * @return Node An object inheriting from Node.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/getRootNode
	 */
	public function getRootNode():Node {

	}

	/**
	 * Returns a Boolean indicating whether or not the element has any
	 * child nodes.
	 *
	 * @return bool A Boolean that is true if the node has child nodes,
	 * and false otherwise.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/hasChildNodes
	 */
	public function hasChildNodes():bool {

	}

	/**
	 * Inserts a Node before the reference node as a child of a
	 * specified parent node.
	 *
	 * @param Node $newNode The node to be inserted.
	 * @param Node $refNode The node before which newNode is inserted. If
	 * this is null, then newNode is inserted at the end of parentNode's
	 * child nodes.
	 * @return Node The node being inserted (the same as newNode)
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/insertBefore
	 */
	public function insertBefore(Node $newNode, Node $refNode):Node {
		$nativeNewNode = $this->ownerDocument->getNativeDomNode($newNode);
		$nativeRefNode = $this->ownerDocument->getNativeDomNode($refNode);
		$inserted = $this->domNode->insertBefore(
			$nativeNewNode,
			$nativeRefNode
		);
		return $this->ownerDocument->getGtDomNode($inserted);
	}

	/**
	 * Accepts a namespace URI as an argument and returns a Boolean with a
	 * value of true if the namespace is the default namespace on the given
	 * node or false if not.
	 *
	 * @param string $namespaceURI a string representing the namespace
	 * against which the element will be checked.
	 * @return bool a Boolean that holds the return value true or false.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/isDefaultNamespace
	 */
	public function isDefaultNamespace(string $namespaceURI):bool {

	}

	/**
	 * Returns a Boolean which indicates whether or not two nodes are of
	 * the same type and all their defining data points match.
	 *
	 * @param Node $otherNode The Node to compare equality with.
	 * @return bool
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/isEqualNode
	 */
	public function isEqualNode(Node $otherNode):bool {

	}

	/**
	 * Returns a Boolean value indicating whether or not the two nodes are
	 * the same (that is, they reference the same object).
	 *
	 * @param Node $otherNode The Node to test against.
	 * @return bool
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/isSameNode
	 */
	public function isSameNode(Node $otherNode):bool {

	}

	/**
	 * Returns a DOMString containing the prefix for a given namespace URI,
	 * if present, and null if not. When multiple prefixes are possible,
	 * the result is implementation-dependent.
	 *
	 * @return ?string
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/lookupPrefix
	 */
	public function lookupPrefix():?string {

	}

	/**
	 * Accepts a prefix and returns the namespace URI associated with it on
	 * the given node if found (and null if not). Supplying null for the
	 * prefix will return the default namespace.
	 *
	 * @param ?string $prefix The prefix to look for. If this parameter is
	 * null, the method will return the default namespace URI, if any.
	 * @return ?string A DOMString containing the namespace URI. If the
	 * prefix is not found, it returns null.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/lookupNamespaceURI
	 */
	public function lookupNamespaceURI(string $prefix = null):?string {

	}

	/**
	 * Clean up all the text nodes under this element (merge adjacent,
	 * remove empty).
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/normalize
	 */
	public function normalize():void {

	}

	/**
	 * Removes a child node from the current element, which must be a
	 * child of the current node.
	 *
	 * @param Node $oldNode holds a reference to the removed child node,
	 * i.e., oldChild === child.
	 * @return Node
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/removeChild
	 */
	public function removeChild(Node $oldNode):Node {

	}

	/**
	 * Replaces one child Node of the current one with the second one given
	 * in parameter.
	 *
	 * @param Node $newNode The new node to replace oldChild. If it already
	 * exists in the DOM, it is first removed.
	 * @param Node $oldNode The child to be replaced.
	 * @return Node The returned value is the replaced node. This is the same node as oldChild.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Node/replaceChild
	 */
	public function replaceChild(Node $newNode, Node $oldNode):Node {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/baseURI */
	protected function __prop_get_baseURI():string {
		throw new ClientSideOnlyFunctionalityException();
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/childNodes */
	protected function __prop_get_childNodes():NodeList {
		return NodeListFactory::createLive(function() {
			$nodeArray = [];

			$nativeChildNodes = $this->domNode->childNodes;
			for($i = 0, $len = $nativeChildNodes->length; $i < $len; $i++) {
				$nativeNode = $nativeChildNodes->item($i);
				$gtNode = $this->ownerDocument->getGtDomNode($nativeNode);
				array_push($nodeArray, $gtNode);
			}

			return NodeListFactory::create(...$nodeArray);
		});
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/firstChild */
	protected function __prop_get_firstChild():?Node {
		$nativeNode = $this->domNode->firstChild;
		if(!$nativeNode) {
			return null;
		}

		return $this->ownerDocument->getGtDomNode($nativeNode);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/isConnected */
	protected function __prop_get_isConnected():bool {
		if(!$this->parentNode) {
			return false;
		}

		$context = $this;
		while($context) {
			$context = $context->parentNode;
			if($context === $this->ownerDocument) {
				return true;
			}
		}

		return false;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/lastChild */
	protected function __prop_get_lastChild():?Node {
		$nativeNode = $this->domNode->lastChild;
		if(!$nativeNode) {
			return null;
		}

		return $this->ownerDocument->getGtDomNode($nativeNode);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/nextSibling */
	protected function __prop_get_nextSibling():?Node {
		$nativeNode = $this->domNode->nextSibling;
		if(!$nativeNode) {
			return null;
		}

		return $this->ownerDocument->getGtDomNode($nativeNode);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/nodeName */
	protected function __prop_get_nodeName():string {
		return $this->domNode->nodeName;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/nodeType */
	protected function __prop_get_nodeType():int {
		return $this->domNode->nodeType;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/nodeValue */
	protected function __prop_get_nodeValue():?string {
		if(in_array($this->nodeType, [
			self::TYPE_DOCUMENT_NODE,
			self::TYPE_DOCUMENT_FRAGMENT_NODE,
			self::TYPE_DOCUMENT_TYPE_NODE,
			self::TYPE_ELEMENT_NODE,
		])) {
			return null;
		}

		return $this->domNode->nodeValue;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/nodeValue */
	protected function __prop_set_nodeValue(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/ownerDocument */
	protected function __prop_get_ownerDocument():?Document {
		if($this instanceof Document) {
			$nativeDocument = $this->domDocument;
		}
		else {
			$nativeDocument = $this->domNode->ownerDocument;
		}
		/** @var DOMDocumentFacade $nativeDocument */
		/** @var Document $gtDocument */
		$gtDocument = $nativeDocument->getGtDomNode($nativeDocument);
		return $gtDocument;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/parentNode */
	protected function __prop_get_parentNode():?Node {
		$nativeNode = $this->domNode->parentNode;
		if(!$nativeNode) {
			return null;
		}

		return $this->ownerDocument->getGtDomNode($nativeNode);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/parentElement */
	protected function __prop_get_parentElement():?Node {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/previousSibling */
	protected function __prop_get_previousSibling():?Node {
		$nativeNode = $this->domNode->previousSibling;
		if(!$nativeNode) {
			return null;
		}

		return $this->ownerDocument->getGtDomNode($nativeNode);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/textContent */
	protected function __prop_get_textContent():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Node/textContent */
	protected function __prop_set_textContent():void {

	}
}
