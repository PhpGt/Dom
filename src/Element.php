<?php
namespace Gt\Dom;

use DOMXPath;
use Symfony\Component\CssSelector\CssSelectorConverter;

/**
 * Represents an object of a Document.
 * @property-read string $innerHTML
 * @property-read TokenList $classList
 */
class Element extends \DOMElement {
use LiveProperty, NonDocumentTypeChildNode, ChildNode, ParentNode;

/** @var  TokenList */
private $liveProperty_classList;

/** @return Element|null */
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
 * @param string $selectors The CSS selector(s) to check against
 * @return bool True if this element is selectable by provided selector
 */
public function matches(string $selectors):bool {
	$matches = $this->ownerDocument->querySelectorAll($selectors);
	$i = $matches->length;
	while(--$i >= 0 && $matches->item($i) !== $this);

	return($i >= 0);
}

/**
 * Returns a live HTMLCollection containing all child elements which have all
 * of the given class names. When called on the document object, the complete
 * document is searched, including the root node.
 * @param string $names a string representing the list of class names to
 *  match; class names are separated by whitespace
 * @return HTMLCollection
 */
public function getElementsByClassName(string $names):HTMLCollection {
	$namesArray = explode(" ", $names);
	$dots = "." . implode(".", $namesArray);
	return $this->css($dots);
}
/**
 * Returns the closest ancestor of the current element (or itself)
 * which matches the selectors.
 * @param string $selectors CSS selector(s)
 * @return Element|null
 */
public function closest(string $selectors) {
	$collection = $this->css($selectors, "ancestor-or-self::");
	return $collection->item(count($collection) - 1);
}

/**
 * @param string $selectors CSS selector(s)
 * @param string $prefix
 * @return HTMLCollection
 */
private function css(
string $selectors, string $prefix = "descendant-or-self::"):HTMLCollection {
	$converter = new CssSelectorConverter();
	$xPathSelector = $converter->toXPath($selectors, $prefix);
	return $this->xPath($xPathSelector);
}

private function xPath(string $selector):HTMLCollection {
	$x = new DOMXPath($this->ownerDocument);
	return new HTMLCollection($x->query($selector, $this));
}

public function prop_get_className() {
	return $this->getAttribute("class");
}

public function prop_get_classList() {
	if(!$this->liveProperty_classList) {
		$this->liveProperty_classList = new TokenList($this, "class");
	}

	return $this->liveProperty_classList;
}

public function prop_get_value() {
	$methodName = 'value_get_' . $this->tagName;
	if(method_exists($this, $methodName)) {
		return $this->$methodName();
	}

	return null;
}

public function prop_set_value($newValue) {
	$methodName = 'value_set_' . $this->tagName;
	if(method_exists($this, $methodName)) {
		return $this->$methodName($newValue);
	}
}

public function prop_get_id():string {
	return $this->getAttribute("id");
}

public function prop_set_id($newValue) {
	$this->setAttribute("id", $newValue);
}

public function prop_get_innerHTML():string {
	$childHtmlArray = [];
	foreach($this->children as $child) {
		$childHtmlArray []= $this->ownerDocument->saveHTML($child);
	}

	return implode(PHP_EOL, $childHtmlArray);
}

public function prop_get_outerHTML():string {
	return $this->ownerDocument->saveHTML($this);
}

private function value_set_select($newValue) {
	$options = $this->getElementsByTagName('option');
	$selectedIndexes = [];
	$newSelectedIndex = NULL;

	for($i = $options->length - 1; $i >= 0; --$i) {
		if(self::isSelectOptionSelected($options->item($i))) {
			$selectedIndexes[] = $i;
		}

		if($options->item($i)->getAttribute('value') == $newValue) {
			$newSelectedIndex = $i;
		}
	}

	if($newSelectedIndex !== NULL) {
		foreach ($selectedIndexes as $i) {
			$options->item($i)->removeAttribute('selected');
		}

		$options->item($newSelectedIndex)->setAttribute('selected', 'selected');
	}
}

private function value_get_select() {
	$options = $this->getElementsByTagName('option');
	if ($options->length == 0) {
		$value = '';
	}
	else {
		$value = $options->item(0)->getAttribute('value');
	}

	foreach ($options as $option) {
		if (self::isSelectOptionSelected($option)) {
			$value = $option->getAttribute('value');
			break;
		}
	}

	return $value;
}

private function value_set_input(string $newValue) {
	return $this->setAttribute("value", $newValue);
}

private function value_get_input() {
	return $this->getAttribute("value");
}

static public function isSelectOptionSelected(Element $option) {
	return $option->hasAttribute('selected') && $option->getAttribute('selected');
}
}#
