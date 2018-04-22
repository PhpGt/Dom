<?php
namespace Gt\Dom;

use DOMDocument;
use DOMElement;
use DOMXPath;
use Symfony\Component\CssSelector\CssSelectorConverter;

/**
 * The most general base class from which all objects in a Document inherit.
 *
 * @property string $className Gets and sets the value of the class attribute
 * @property-read TokenList $classList Returns a live TokenList collection of
 * the class attributes of the element
 * @property string $value Gets or sets the value of the element according to
 * its element type
 * @property string $id Gets or sets the value of the id attribute
 * @property string $innerHTML Gets or sets the HTML syntax describing the
 * element's descendants
 * @property string $outerHTML Gets or sets the HTML syntax describing the
 * element and its descendants. It can be set to replace the element with nodes
 * parsed from the given string
 * @property string $innerText
 */
class Element extends DOMElement {
	use LiveProperty, NonDocumentTypeChildNode, ChildNode, ParentNode;

	/** @var  TokenList */
	private $liveProperty_classList;

	/**
	 * returns true if the element would be selected by the specified selector
	 * string; otherwise, returns false.
	 * @param string $selectors The CSS selector(s) to check against
	 * @return bool True if this element is selectable by provided selector
	 */
	public function matches(string $selectors):bool {
		$matches = $this->getRootDocument()->querySelectorAll($selectors);
		$i = $matches->length;
		while(--$i >= 0 && $matches->item($i) !== $this) {
			;
		}

		return ($i >= 0);
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

	public function getAttribute($name):?string {
		$value = parent::getAttribute($name);
		if(strlen($value) === 0) {
			return null;
		}

		return $value;
	}


	public function prop_get_className() {
		return $this->getAttribute("class");
	}

	public function prop_set_className(string $value):void {
		$this->setAttribute("class", $value);
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

	public function prop_set_value(string $newValue) {
		$methodName = 'value_set_' . $this->tagName;
		if(method_exists($this, $methodName)) {
			return $this->$methodName($newValue);
		}
	}

	public function prop_get_id():?string {
		return $this->getAttribute("id");
	}

	public function prop_set_id(string $newValue):void {
		$this->setAttribute("id", $newValue);
	}

	public function prop_get_innerHTML():string {
		$childHtmlArray = [];
		foreach($this->childNodes as $child) {
			$childHtmlArray [] = $this->ownerDocument->saveHTML($child);
		}

		return implode(PHP_EOL, $childHtmlArray);
	}

	public function prop_set_innerHTML(string $html):void {
		$fragment = $this->ownerDocument->createDocumentFragment();
// The wrapper DIV allows non-XML to be appended.
		$fragment->appendXML($html);

		while($this->firstChild) {
			$this->removeChild($this->firstChild);
		}

		while($fragment->firstChild) {
			$this->appendChild($fragment->firstChild);
		}
	}

	public function prop_get_outerHTML():string {
		return $this->ownerDocument->saveHTML($this);
	}

	public function prop_set_outerHTML(string $html):void {
		$fragment = $this->ownerDocument->createDocumentFragment();
		$fragment->appendXML($html);
		$this->replaceWith($fragment);
	}

	public function prop_get_innerText():string {
		return $this->textContent;
	}

	public function prop_set_innerText(string $value):string {
		$this->textContent = $value;
		return $this->textContent;
	}

	protected function getRootDocument():DOMDocument {
		return $this->ownerDocument;
	}

	private function value_set_select(string $newValue):void {
		$options = $this->getElementsByTagName('option');
		$selectedIndexes = [];
		$newSelectedIndex = null;

		for($i = $options->length - 1; $i >= 0; --$i) {
			if(self::isSelectOptionSelected($options->item($i))) {
				$selectedIndexes[] = $i;
			}

			if($options->item($i)->getAttribute('value') == $newValue) {
				$newSelectedIndex = $i;
			}
		}

		if($newSelectedIndex !== null) {
			foreach($selectedIndexes as $i) {
				$options->item($i)->removeAttribute('selected');
			}

			$options->item($newSelectedIndex)->setAttribute('selected', 'selected');
		}
	}

	private function value_get_select():string {
		$options = $this->getElementsByTagName('option');
		if($options->length == 0) {
			$value = '';
		}
		else {
			$value = $options->item(0)->getAttribute('value');
		}

		foreach($options as $option) {
			if(self::isSelectOptionSelected($option)) {
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
}
