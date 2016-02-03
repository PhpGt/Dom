<?php
namespace phpgt\dom;

use DOMXPath;
use Symfony\Component\CssSelector\CssSelectorConverter;

/**
 * ParentNode properties:
 * @property-read HTMLCollection $children
 * @property-read Element $firstElementChild
 * @property-read Element $lastElementChild
 * @property-read int $childElementCount
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