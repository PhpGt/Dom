<?php
namespace Gt\Dom;

use DOMElement;
use DOMNamedNodeMap;
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
 * @property-read null|Node|Element $firstChild
 * @property-read null|Element $firstElementChild
 * @property-read null|Node|Element $lastChild
 * @property-read null|Element $lastElementChild
 * @property string $id Is a DOMString representing the id of the element.
 * @property string $innerHTML Is a DOMString representing the markup of the element's content.
 * @property-read ?string $namespaceURI The namespace URI of the element, or null if it is no namespace.
 * @property-read null|Element $nextElementSibling An Element, the element immediately following the given one in the tree, or null if there's no sibling node.
 * @property-read null|Node|Element $nextSibling Returns a Node representing the next node in the tree, or null if there isn't such node.
 * @property-read null|Node|Element $previousSibling Returns a Node representing the previous node in the tree, or null if there isn't such node.
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
	use ElementNode;

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
		return $this->getAttribute("class");
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
			"html-fragment")->item(0);

		$imported = $tempDocument->importNode(
			$innerFragmentNode,
			true
		);

		while($imported->firstChild) {
			$this->ownerDocument->appendChild($imported->firstChild);
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/outerHTML */
	protected function __prop_get_outerHTML():string {
		return $this->ownerDocument->saveHTML($this);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/outerHTML */
	protected function __prop_set_outerHTML(string $outerHTML):void {
		if(!$this->parentNode) {
			return;
		}

		$tempDocument = new HTMLDocument();
		$tempDocument->loadHTML($outerHTML);
		$body = $tempDocument->getElementsByTagName("body")->item(0);

		$this->parentNode->removeChild($this);
		for($i = 0, $len = $body->childNodes->length; $i < $len; $i++) {
			$imported = $this->ownerDocument->importNode(
				$body->childNodes->item($i),
				true
			);
			$this->parentNode->insertBefore(
				$imported,
				$this->nextSibling
			);
		}
	}
}
