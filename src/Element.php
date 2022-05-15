<?php
namespace Gt\Dom;

use DOMElement;
use Gt\PropFunc\MagicProp;

/**
 * @property-read HTMLDocument|XMLDocument $document
 * @property string $innerHTML
 * @property-read ElementType $elementType
 */
class Element extends DOMElement {
	use MagicProp;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/Element/innerHTML */
	public function __prop_get_innerHTML():string {
		$html = "";

		foreach($this->childNodes as $child) {
			$html .= $this->ownerDocument->saveHTML($child);
		}

		return $html;
	}

	public function __prop_get_elementType():ElementType {
		return match($this->tagName) {
			"body" => ElementType::HTMLBodyElement,
			"html" => ElementType::HTMLHtmlElement,
			default => isset($this->document) && $this->document instanceof HTMLDocument ? ElementType::HTMLUnknownElement : ElementType::Element,
		};
	}
}
