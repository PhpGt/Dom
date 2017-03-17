<?php
namespace Gt\Dom;

use DOMDocument;

/**
 * Provides access to special properties and methods not present by default
 * on a regular (XML) document.
 * @property-read HTMLCollection $anchors List of all of the anchors
 *  in the document. Anchors are <a> Elements with the `name` attribute.
 * @property-read Element $body The <body> element. Returns new Element if there
 *  was no body in the source HTML.
 * @property-read HTMLCollection $forms List of all <form> elements.
 * @property-read Element $head The <head> element. Returns new Element if there
 *  was no head in the source HTML.
 * @property-read HTMLCollection $images List of all <img> elements.
 * @property-read HTMLCollection $links List of all links in the document.
 *  Links are <a> Elements with the `href` attribute.
 * @property-read HTMLCollection $scripts List of all <script> elements.
 * @property string $title The title of the document, defined using <title>.
 */
class HTMLDocument extends Document {
use LiveProperty, ParentNode;

public function __construct($document) {
	parent::__construct($document);

	if(!($document instanceof DOMDocument)) {
		$this->loadHTML($document);
	}
}

/** @return Element|null */
public function querySelector(string $selectors) {
	return $this->documentElement->querySelector($selectors);
}

public function querySelectorAll(string $selectors):HTMLCollection {
	return $this->documentElement->querySelectorAll($selectors);
}

public function getElementsByClassName(string $names):HTMLCollection {
	return $this->documentElement->getElementsByClassName($names);
}

private function prop_get_head():Element {
	return $this->getOrCreateElement("head");
}

private function prop_get_body():Element {
	return $this->getOrCreateElement("body");
}

private function prop_get_forms() {
	return $this->getElementsByTagName("form");
}

private function prop_get_anchors() {
	return $this->querySelectorAll("a[name]:not(a[name=''])");
}

private function prop_get_images() {
	return $this->getElementsByTagName("img");
}

private function prop_get_links() {
	return $this->querySelectorAll("a[href]:not(a[href=''])");
}

private function prop_get_title() {
	$title = $this->head->getElementsByTagName("title")->item(0);

	if(is_null($title)) {
		return "";
	}
	else {
		return $title->textContent;
	}
}

private function prop_set_title($value) {
	$title = $this->head->getElementsByTagName("title")->item(0);

	if(is_null($title)) {
		$title = $this->createElement("title");
		$this->head->appendChild($title);
	}

	$title->textContent = $value;
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
