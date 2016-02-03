<?php
namespace phpgt\dom;

/**
 * @property-read Element $body
 * @property-read HTMLCollection $children
 * @property-read Element $head
 */
class HTMLDocument extends Document {

public function __construct($html) {
	parent::__construct();
	$this->loadHTML($html);
}

public function querySelector(string $selectors) {
	return $this->documentElement->querySelector($selectors);
}

public function querySelectorAll(string $selectors):HTMLCollection {
	return $this->documentElement->querySelectorAll($selectors);
}

public function __get($name) {
	$dynamicPropertyMethodName = "prop_$name";
	if(method_exists($this, $dynamicPropertyMethodName)) {
		return $this->$dynamicPropertyMethodName();
	}
}

private function prop_head():Element {
	return $this->getOrCreateElement("head");
}

private function prop_body():Element {
	return $this->getOrCreateElement("body");
}

private function prop_children():HTMLCollection {
	return $this->documentElement->children;
}

private function getOrCreateElement(string $tagName):Element {
	$element = $this->documentElement->querySelector($tagName);
	if(is_null($element)) {
		$element = $this->createElement($tagName);
		$this->documentElement->appendChild($element);
	}

	return $element;
}

}#