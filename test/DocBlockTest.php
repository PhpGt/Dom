<?php
/**
 * This file is not a unit test. It doesn't do anything if executed.
 * Instead, it is intended to be loaded in your IDE of choice to ensure that
 * all properties are evaluated correctly, and native DOMDocument functionality
 * has been correctly overridden.
 *
 * For example, in PhpStorm, code that doesn't evaluate correctly is highlighted
 * as part fo the "inspection" process. You can also try out the code completion
 * in this document.
 */

use Gt\Dom\Test\Helper\Helper;

require("../vendor/autoload.php");

$document = new \Gt\Dom\HTMLDocument(Helper::HTML_MORE);

$document->doctype->remove();
$documentElement = $document->documentElement;
$owner = $document->ownerDocument;
$body = $owner->documentElement->querySelector("body");
$body = $documentElement->querySelector("body");
$attribute = $body->setAttribute("class", "example");
// Make sure that $attribute is actually an Attr object:
$attribute->name;
$body->parentNode->tagName;
$body->firstChild->remove();
$body->lastChild->remove();
$body->nextSibling;

$anchors = $document->anchors;
// You should get code completion for `Element` on after the [0]:
$document->body->children[0]->classList->add("test");
$newElement = $document->createElement("div");
$newElement->getElementById("test")->querySelector("test2");

foreach($document->getElementsByTagName("input") as $input) {
	if($input->checked) {
		$input->classList->add("i-am-checked");
	}
}