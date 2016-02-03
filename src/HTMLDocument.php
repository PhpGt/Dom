<?php
namespace phpgt\dom;

/**
 * @property-read Element $body
 * @property-read Element $head
 */
class HTMLDocument extends Document {
use LivePropertyGetter, ParentNode;

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

private function prop_head():Element {
	return $this->getOrCreateElement("head");
}

private function prop_body():Element {
	return $this->getOrCreateElement("body");
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