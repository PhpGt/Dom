<?php
namespace phpgt\dom;

use DOMXPath;
use Symfony\Component\CssSelector\CssSelectorConverter;

class Element extends \DOMElement {

/**
 * Removes the object from the tree it belongs to.
 * @return void
 */
public function remove() {
	$this->parentNode->removeChild($this);
}

public function querySelector(string $selector):Element {
	$nodeList = $this->css($selector);
	return $nodeList->item(0);
}

public function querySelectorAll(string $selector):NodeList {
	return $this->css($selector);
}

private function css(string $selector):NodeList {
	$converter = new CssSelectorConverter();
	$xPathSelector = $converter->toXPath($selector);
	return $this->xPath($xPathSelector);
}

private function xPath(string $selector):NodeList {
	$x = new DOMXPath($this->ownerDocument);
	return new NodeList($x->query($selector, $this));
}

}#