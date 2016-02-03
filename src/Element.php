<?php
namespace phpgt\dom;

use DOMXPath;
use Symfony\Component\CssSelector\CssSelectorConverter;

/**
 * Represents an object of a Document.
 */
class Element extends \DOMElement {
use LivePropertyGetter, NonDocumentTypeChildNode, ChildNode, ParentNode;

public function querySelector(string $selector) {
	$htmlCollection = $this->css($selector);
	return $htmlCollection->item(0);
}

public function querySelectorAll(string $selector):HTMLCollection {
	return $this->css($selector);
}

/**
 * returns true if the element would be selected by the specified selector
 * string; otherwise, returns false.
 *
 * @param string $selector The CSS selector to check against
 * @return bool True if this element is selectable by provided selector
 */
public function matches(string $selector):bool {
	// TODO. https://github.com/phpgt/dom/issues/7
}

private function css(string $selector):HTMLCollection {
	$converter = new CssSelectorConverter();
	$xPathSelector = $converter->toXPath($selector);
	return $this->xPath($xPathSelector);
}

private function xPath(string $selector):HTMLCollection {
	$x = new DOMXPath($this->ownerDocument);
	return new HTMLCollection($x->query($selector, $this));
}

}#