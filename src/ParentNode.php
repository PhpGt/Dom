<?php
namespace Gt\Dom;

use DOMDocument;
use DOMNode;
use DOMXPath;
use Gt\CssXPath\Translator;
use Gt\Dom\Facade\DOMDocumentFacade;
use Gt\Dom\Facade\HTMLCollectionFactory;
use Gt\Dom\Facade\NodeClass\DOMElementFacade;
use Gt\Dom\Facade\NodeClass\DOMNodeFacade;
use Gt\Dom\Facade\NodeListFactory;

/**
 * @link https://dom.spec.whatwg.org/#parentnode
 * @link https://developer.mozilla.org/en-US/docs/Web/API/ParentNode
 *
 * Contains methods and properties that are common to all types of Node objects
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
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/ParentNode/childElementCount */
	protected function __prop_get_childElementCount():int {
		$count = 0;

		/** @var Node $this */
		/** @var DOMNodeFacade $nativeNode */
		$nativeNode = $this->ownerDocument->getNativeDomNode($this);
		$childNodes = $nativeNode->childNodes;
		for($i = 0, $len = $childNodes->length; $i < $len; $i++) {
			$nativeChild = $childNodes->item($i);
			if($nativeChild instanceof DOMElementFacade) {
				$count++;
			}
		}

		return $count;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/ParentNode/children */
	protected function __prop_get_children():HTMLCollection {
		return HTMLCollectionFactory::create(function() {
			$elementArray = [];

			for($i = 0, $len = $this->childNodes->length; $i < $len; $i++) {
				$child = $this->childNodes->item($i);
				if(!$child instanceof Element) {
					continue;
				}

				array_push($elementArray, $child);
			}

			return NodeListFactory::create(...$elementArray);
		});
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/ParentNode/firstElementChild */
	protected function __prop_get_firstElementChild():?Element {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/ParentNode/lastElementChild */
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
		foreach($nodesOrDOMStrings as $nodeOrString) {
			$node = $nodeOrString;
			if(is_string($nodeOrString)) {
				/** @var Document $doc */
				$doc = $this->ownerDocument ?? $this;
				$node = $doc->createTextNode($nodeOrString);
			}

			$this->appendChild($node);
		}
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
		/** @var Element[] $all */
		$all = $this->querySelectorAll($selectors);
// TODO: Is there a case for optimisation here?
// Test with a document of thousands of nodes to compare efficiency.
		return $all[0] ?? null;
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
		$context = $this;
		$prefix = ".//";
		if($this instanceof Document) {
			$context = $this->firstChild;
			$prefix = "//";
		}

		$translator = new Translator($selectors, $prefix);
		$xpathResult = $this->ownerDocument->evaluate(
			$translator,
			$context
		);
		$nodeArray = iterator_to_array($xpathResult);
		return NodeListFactory::create(...$nodeArray);
	}
}
