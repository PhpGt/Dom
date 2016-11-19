<?php
namespace Gt\Dom;

/**
 * Represents a minimal document object that has no parent. It is used as a
 * light-weight version of Document to store well-formed or potentially
 * non-well-formed fragments of XML.
 *
 * Various other methods can take a document fragment as an argument (e.g.,
 * any Node interface methods such as Node.appendChild and Node.insertBefore),
 * in which case the children of the fragment are appended or inserted, not
 * the fragment itself.
 *
 * This interface is also of great use with Web components: <template>
 * elements contains a DocumentFragment in their HTMLTemplateElement::$content
 * property.
 *
 * An empty DocumentFragment can be created using the
 * Document::createDocumentFragment() method or the constructor.
 */
class DocumentFragment extends \DOMDocumentFragment {
use LiveProperty, ParentNode;

/**
 * @param string $id
 * @return Element|null
 */
public function getElementById(string $id)/*:?Element*/ {
	return $this->callMethodOnTemporaryElement(
		"querySelector", ["#" . $id]);
}

/**
 * @param string $selectors CSS selector(s)
 * @return Element|null
 */
public function querySelector(string $selectors) {
    return $this->callMethodOnTemporaryElement(
        "querySelector", [$selectors]);
}

/**
 * @param string $selectors CSS selector(s)
 * @return HTMLCollection
 */
public function querySelectorAll(string $selectors):HTMLCollection {
    return $this->callMethodOnTemporaryElement(
        "querySelectorAll", [$selectors]);
}

private function callMethodOnTemporaryElement(string $methodName, array $args) {
	$childNodes = [];

    $tempElement = $this->ownerDocument->createElement("document-fragment");

	while($this->firstChild) {
		$childNodes []= $this->firstChild;
		$tempElement->appendChild($this->firstChild);
	}

    $result = call_user_func_array([$tempElement, $methodName], $args);

	foreach($childNodes as $node) {
		$this->appendChild($node);
	}

    return $result;
}

}#