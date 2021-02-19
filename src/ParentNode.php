<?php
namespace Gt\Dom;

use DOMDocument;
use DOMNode;
use DOMXPath;
use Gt\CssXPath\Translator;

/**
 * @see https://dom.spec.whatwg.org/#parentnode
 * @see https://developer.mozilla.org/en-US/docs/Web/API/ParentNode
 *
 * contains methods and properties that are common to all types of Node objects
 * that can have children. It's implemented by Element, Document, and
 * DocumentFragment objects.
 *
 * @property-read int $childElementCount The number of children of this
 * ParentNode which are elements.
 * @property-read HTMLCollection $children A live HTMLCollection containing all
 *  objects of type Element that are children of this ParentNode.
 * @property-read ?Element $firstElementChild The Element that is the first
 *  child of this ParentNode.
 * @property-read ?Element $lastElementChild The Element that is the last
 *  child of this ParentNode.
 */
trait ParentNode {
	protected function __prop_get_childElementCount():int {

	}

	protected function __prop_get_children():HTMLCollection {

	}

	protected function __prop_get_firstElementChild():?Element {

	}

	protected function __prop_get_lastElementChild():?Element {

	}

	/**
	 * The ParentNode.prepend() method inserts a set of Node objects or
	 * DOMString objects before the first child of the ParentNode.
	 * DOMString objects are inserted as equivalent Text nodes.
	 *
	 * @param string|Node ...$nodesOrDOMStrings A set of Node or DOMString
	 * objects to insert.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ParentNode/prepend
	 */
	public function prepend(string|Node...$nodesOrDOMStrings):void {

	}

	/**
	 * Inserts a set of Node objects or DOMString objects after the last
	 * child of the ParentNode. DOMString objects are inserted as
	 * equivalent Text nodes.
	 *
	 * @param string|Node ...$nodesOrDOMStrings A set of Node or DOMString
	 * objects to insert.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ParentNode/append
	 */
	public function append(string|Node...$nodesOrDOMStrings):void {

	}

	/**
	 * The ParentNode.replaceChildren() method replaces the existing
	 * children of a Node with a specified new set of children. These can
	 * be DOMString or Node objects.
	 *
	 * @param string|Node ...$nodesOrDOMStrings A set of Node or DOMString
	 * objects to replace the ParentNode's existing children with. If no
	 * replacement objects are specified, then the ParentNode is emptied of
	 * all child nodes.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ParentNode/replaceChildren
	 */
	public function replaceChildren(string|Node...$nodesOrDOMStrings):void {

	}

	/**
	 * The Document method querySelector() returns the first Element within
	 * the document that matches the specified selector, or group of
	 * selectors. If no matches are found, null is returned.
	 *
	 * @param string $selectors A DOMString containing one or more selectors
	 * to match against. This string must be a valid compound selector list
	 * supported by the browser; if it's not, a SyntaxError exception is
	 * thrown. See Locating DOM elements using selectors for more
	 * information about using selectors to identify elements. Multiple
	 * selectors may be specified by separating them using commas.
	 * @return ?Element The first Element that matches at least one of the
	 * specified selectors or null if no such element is found.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ParentNode/querySelector
	 */
	public function querySelector(string $selectors):?Element {

	}

	/**
	 * The Document method querySelectorAll() returns a static (not live)
	 * NodeList representing a list of the document's elements that match
	 * the specified group of selectors.
	 *
	 * @param string $selectors A DOMString containing one or more selectors
	 * to match against. This string must be a valid CSS selector string; if
	 * it's not, a SyntaxError exception is thrown. See Locating DOM
	 * elements using selectors for more information about using selectors
	 * to identify elements. Multiple selectors may be specified by
	 * separating them using commas.
	 * @return NodeList A non-live NodeList containing one Element object
	 * for each descendant node that matches at least one of the specified
	 * selectors.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ParentNode/querySelectorAll
	 */
	public function querySelectorAll(string $selectors):NodeList {

	}
}
