<?php
namespace Gt\Dom;

use DOMElement;
use DOMNamedNodeMap;
use Gt\Dom\Exception\InvalidAdjacentPositionException;
use Gt\Dom\Exception\XPathQueryException;
use Gt\PropFunc\MagicProp;

/**
 * @property-read HTMLDocument|XMLDocument $document
 * @property-read HTMLDocument|XMLDocument $ownerDocument
 *
 * @property-read DOMNamedNodeMap<Attr> $attributes Returns a NamedNodeMap object containing the assigned attributes of the corresponding HTML element.
 * @property-read NodeList<Node|Element> $childNodes
 * @property-read DOMTokenList $classList Returns a DOMTokenList containing the list of class attributes.
 * @property string $className Is a DOMString representing the class of the element.
 * @property-read ElementType $elementType
 * @property-read null|Element $firstElementChild
 * @property-read null|Element $lastElementChild
 * @property string $id Is a DOMString representing the id of the element.
 * @property string $innerHTML Is a DOMString representing the markup of the element's content.
 * @property-read ?string $namespaceURI The namespace URI of the element, or null if it is no namespace.
 * @property-read null|Element $nextElementSibling An Element, the element immediately following the given one in the tree, or null if there's no sibling node.
 * @property-read null|Element $previousElementSibling Returns a Node representing the previous node in the tree, or null if there isn't such node.
 * @property string $outerHTML Is a DOMString representing the markup of the element including its content. When used as a setter, replaces the element with nodes parsed from the given string.
 * @property-read string $prefix A DOMString representing the namespace prefix of the element, or null if no prefix is specified.
 * @property-read string $tagName Returns a String with the name of the tag for the given element.
 */
class Element extends DOMElement {
	use MagicProp;
	use NonDocumentTypeChildNode;
	use ChildNode;
	use ParentNode;
	use RegisteredNodeClass;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/classList */
	protected function __prop_get_classList():DOMTokenList {
		return DOMTokenListFactory::create(
			fn() => explode(" ", $this->className),
			function(string...$tokens) {
				$this->className = implode(" ", $tokens);
			}
		);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/className */
	protected function __prop_get_className():string {
		return $this->getAttribute("class") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/className */
	protected function __prop_set_className(string $className):void {
		$this->setAttribute("class", $className);
	}

	public function __prop_get_elementType():ElementType {
		return match($this->tagName) {
			"body" => ElementType::HTMLBodyElement,
			"head" => ElementType::HTMLHeadElement,
			"html" => ElementType::HTMLHtmlElement,
			default => isset($this->ownerDocument) && $this->ownerDocument instanceof HTMLDocument
				? ElementType::HTMLUnknownElement
				: ElementType::Element,
		};
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/id */
	protected function __prop_get_id():string {
		return $this->getAttribute("id");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/id */
	protected function __prop_set_id(string $id):void {
		$this->setAttribute("id", $id);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/innerHTML */
	public function __prop_get_innerHTML():string {
		$html = "";

		foreach($this->childNodes as $child) {
			$html .= $this->ownerDocument->saveHTML($child);
		}

		return $html;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/innerHTML */
	protected function __prop_set_innerHTML(string $innerHTML):void {
		while($child = $this->firstChild) {
			/** @var Element $child */
			$child->parentNode->removeChild($child);
		}

		$innerHTML = mb_convert_encoding(
			$innerHTML,
			"HTML-ENTITIES",
			"utf-8"
		);

		$tempDocument = new HTMLDocument();
		$tempDocument->loadHTML(
			"<html-fragment>$innerHTML</html-fragment>"
		);
		$innerFragmentNode = $tempDocument->getElementsByTagName(
			"html-fragment"
		)->item(0);

		$imported = $this->ownerDocument->importNode(
			$innerFragmentNode,
			true
		);

		while($imported->firstChild) {
			$this->appendChild($imported->firstChild);
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/outerHTML */
	protected function __prop_get_outerHTML():string {
		return $this->ownerDocument->saveHTML($this);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/outerHTML */
	protected function __prop_set_outerHTML(string $outerHTML):void {
		$parentNode = $this->parentNode;
		if(!$parentNode) {
			return;
		}

		$tempDocument = new HTMLDocument();
		$tempDocument->loadHTML($outerHTML);
		$body = $tempDocument->getElementsByTagName("body")->item(0);

		$parentNode->removeChild($this);
		for($i = 0, $len = $body->childNodes->length; $i < $len; $i++) {
			$imported = $this->ownerDocument->importNode(
				$body->childNodes->item($i),
				true
			);
			$parentNode->insertBefore(
				$imported,
				$this->nextSibling
			);
		}
	}

	/**
	 * The closest() method traverses the Element and its parents (heading
	 * toward the document root) until it finds a node that matches the
	 * provided selector string. Will return itself or the matching
	 * ancestor. If no such element exists, it returns null.
	 *
	 * @param string $selectors a DOMString containing a selector list.
	 * ex: p:hover, .toto + q
	 * @return ?Element The Element which is the closest ancestor of the
	 * selected element. It may be null.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/closest
	 */
	public function closest(string $selectors):?Element {
		$furthestAncestor = $this;
		while($furthestAncestor->parentElement) {
			$furthestAncestor = $furthestAncestor->parentElement;
		}
		if($furthestAncestor === $this) {
			$furthestAncestor = $this->ownerDocument;
		}

		$matchesArray = iterator_to_array(
			$furthestAncestor->querySelectorAll($selectors)
		);
		$context = $this;

		do {
			if(in_array($context, $matchesArray, true)) {
				return $context;
			}
		}
		while($context = $context->parentElement);

		return null;
	}

	/**
	 * The insertAdjacentElement() method of the Element interface inserts
	 * a given element node at a given position relative to the element it
	 * is invoked upon.
	 *
	 * @param string $position A DOMString representing the position
	 * relative to the targetElement; must match (case-insensitively) one
	 * of the following strings:
	 * 'beforebegin': Before the targetElement itself.
	 * 'afterbegin': Just inside the targetElement, before its first child.
	 * 'beforeend': Just inside the targetElement, after its last child.
	 * 'afterend': After the targetElement itself.
	 *
	 * @param Node|Element $element The element to be inserted into the tree.
	 * @return ?Element The element that was inserted, or null, if the
	 * insertion failed.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/insertAdjacentElement
	 */
	public function insertAdjacentElement(
		string $position,
		Node|Element|DocumentFragment|Text $element
	):?Element {
		switch($position) {
		case "beforebegin":
			$context = $this->parentNode;
			$before = $this;
			break;

		case "afterbegin":
			$context = $this;
			$before = $this->firstChild;
			break;

		case "beforeend":
			$context = $this;
			$before = null;
			break;

		case "afterend":
			$context = $this->parentNode;
			$before = $this->nextSibling;
			break;

		default:
			throw new InvalidAdjacentPositionException($position);
		}

		if(!$context) {
			return null;
		}

		/** @var Element $inserted */
		$inserted = $context->insertBefore($element, $before);
		if(!$inserted instanceof Element) {
			return null;
		}

		return $inserted;
	}

	/**
	 * The insertAdjacentHTML() method of the Element interface parses the
	 * specified text as HTML or XML and inserts the resulting nodes into
	 * the DOM tree at a specified position. It does not reparse the element
	 * it is being used on, and thus it does not corrupt the existing
	 * elements inside that element. This avoids the extra step of
	 * serialization, making it much faster than direct innerHTML
	 * manipulation.
	 *
	 * @param string $position A DOMString representing the position
	 * relative to the element; must be one of the following strings:
	 * 'beforebegin': Before the element itself.
	 * 'afterbegin': Just inside the element, before its first child.
	 * 'beforeend': Just inside the element, after its last child.
	 * 'afterend': After the element itself.
	 * @param string $text The string to be parsed as HTML or XML and
	 * inserted into the tree.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/insertAdjacentHTML
	 */
	public function insertAdjacentHTML(
		string $position,
		string $text
	):void {
		$tempTagName = "insert-adjacent-html-temp";
		$tempElement = $this->ownerDocument->createElement($tempTagName);
		$tempElement->innerHTML = $text;
		$fragment = $this->ownerDocument->createDocumentFragment();
		while($child = $tempElement->firstChild) {
			$fragment->appendChild($child);
		}
		$this->insertAdjacentElement($position, $fragment);
	}

	/**
	 * The insertAdjacentText() method of the Element interface inserts a
	 * given text node at a given position relative to the element it is
	 * invoked upon.
	 *
	 * @param string $position A DOMString representing the position
	 * relative to the element; must be one of the following strings:
	 * 'beforebegin': Before the element itself.
	 * 'afterbegin': Just inside the element, before its first child.
	 * 'beforeend': Just inside the element, after its last child.
	 * 'afterend': After the element itself.
	 * @param string $text A DOMString representing the text to be
	 * inserted into the tree.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/insertAdjacentText
	 */
	public function insertAdjacentText(
		string $position,
		string $text
	):void {
		$tempTagName = "insert-adjacent-html-temp";
		$tempElement = $this->ownerDocument->createElement($tempTagName);
		$tempElement->textContent = $text;
		$fragment = $this->ownerDocument->createDocumentFragment();
		while($child = $tempElement->firstChild) {
			$fragment->appendChild($child);
		}
		$this->insertAdjacentElement($position, $fragment);
	}

	/**
	 * The matches() method checks to see if the Element would be selected
	 * by the provided selectorString -- in other words -- checks if the
	 * element "is" the selector.
	 *
	 * @param string $selectorString a string representing the selector to
	 * test.
	 * @return bool
	 * @throws XPathQueryException if the specified selector string is
	 * invalid.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/matches
	 */
	public function matches(string $selectorString):bool {
		$matches = $this->ownerDocument->querySelectorAll($selectorString);
		foreach($matches as $match) {
			if($match === $this) {
				return true;
			}
		}

		return false;
	}

	/**
	 * The toggleAttribute() method of the Element interface toggles a
	 * Boolean attribute (removing it if it is present and adding it if it
	 * is not present) on the given element.
	 *
	 * @param string $name A DOMString specifying the name of the attribute
	 * to be toggled. The attribute name is automatically converted to all
	 * lower-case when toggleAttribute() is called on an HTML element in an
	 * HTML document.
	 * @param bool $force A boolean value to determine whether the attribute
	 * should be added or removed, no matter whether the attribute is
	 * present or not at the moment.
	 * @return bool true if attribute name is eventually present, and false
	 * otherwise.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Element/toggleAttribute
	 */
	public function toggleAttribute(
		string $name,
		bool $force = null
	):bool {
		$add = true;
		if(is_null($force)) {
			if($this->hasAttribute($name)) {
				$add = false;
			}
		}
		else {
			$add = $force;
		}

		if($add) {
			$this->setAttribute($name, "");
			return true;
		}
		else {
			$this->removeAttribute($name);
			return false;
		}
	}
}
