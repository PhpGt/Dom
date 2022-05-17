<?php
namespace Gt\Dom;

use DOMElement;
use Gt\PropFunc\MagicProp;

/**
 * @property-read HTMLDocument|XMLDocument $document
 * @property-read HTMLDocument|XMLDocument $ownerDocument
 *
 * @property-read NamedNodeMap<Attr> $attributes Returns a NamedNodeMap object containing the assigned attributes of the corresponding HTML element.
 * @property-read DOMTokenList $classList Returns a DOMTokenList containing the list of class attributes.
 * @property string $className Is a DOMString representing the class of the element.
 * @property-read ElementType $elementType
 * @property string $id Is a DOMString representing the id of the element.
 * @property string $innerHTML Is a DOMString representing the markup of the element's content.
 * @property-read ?string $namespaceURI The namespace URI of the element, or null if it is no namespace.
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

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/attributes */
	protected function __prop_get_attributes():NamedNodeMap {
		return NamedNodeMapFactory::create(
			fn() => $this->domNode->attributes,
			$this
		);
	}

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

		return; // TODO:

		$tempDocument = new HTMLDocument();
		/** @var DOMDocument $nativeTempDocument */
		$nativeTempDocument = $tempDocument->domNode;
		$nativeTempDocument->loadHTML(
			"<html-fragment>$innerHTML</html-fragment>"
		);
		$innerFragmentNode = $nativeTempDocument->getElementsByTagName(
			"html-fragment")->item(0);

		/** @var DOMDocument $nativeDocument */
		$nativeDocument = $this->ownerDocument->domNode;
		$imported = $nativeDocument->importNode(
			$innerFragmentNode,
			true
		);

		$nativeDomNode = $this->ownerDocument->getNativeDomNode($this);
		while($imported->firstChild) {
			$nativeDomNode->appendChild($imported->firstChild);
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/namespaceURI */
	protected function __prop_get_namespaceURI():?string {
		if(isset($this->domNode->namespaceURI)) {
			return $this->domNode->namespaceURI;
		}

		return null;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/outerHTML */
	protected function __prop_get_outerHTML():string {
		/** @var DOMDocument $nativeDocument */
		$nativeDocument = $this->ownerDocument->domNode;
		return $nativeDocument->saveHTML($this->domNode);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/outerHTML */
	protected function __prop_set_outerHTML(string $outerHTML):void {
		if(!$this->parentNode) {
			return;
		}

		return; //TODO:
		$tempDocument = new HTMLDocument();
		/** @var DOMDocument $nativeTempDocument */
		$nativeTempDocument = $tempDocument->domNode;
		$nativeTempDocument->loadHTML($outerHTML);
		$body = $nativeTempDocument->getElementsByTagName("body")->item(0);
		/** @var DOMDocument $nativeThisDocument */
		$nativeThisDocument = $this->ownerDocument->domNode;
		$nativeNextSibling = $this->domNode->nextSibling;
		$nativeParent = $this->domNode->parentNode;

		$nativeParent->removeChild($this->domNode);
		for($i = 0, $len = $body->childNodes->length; $i < $len; $i++) {
			$imported = $nativeThisDocument->importNode(
				$body->childNodes->item($i),
				true
			);
			$nativeParent->insertBefore(
				$imported,
				$nativeNextSibling
			);
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/prefix */
	protected function __prop_get_prefix():string {
		return $this->domNode->prefix;
	}
}
