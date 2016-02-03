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
class Element extends \DOMElement implements ParentNode {

/**
 * Removes the object from the tree it belongs to.
 * @return void
 */
public function remove() {
	$this->parentNode->removeChild($this);
}

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

public function __get($name) {
	$methodName = "prop_$name";
	if(method_exists($this, $methodName)) {
		return $this->$methodName();
	}
}

private function prop_children():HTMLCollection {
	return new HTMLCollection($this->childNodes);
}

private function prop_firstElementChild() {
	return $this->children->item(0);
}
private function prop_lastElementChild() {
	return $this->children->item($this->children->length - 1);
}
private function prop_childElementCount() {

}

}#