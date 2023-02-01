<?php
namespace Gt\Dom;

use DateTime;
use DOMAttr;
use DOMDocument;
use DOMElement;
use ReturnTypeWillChange;

/**
 * The most general base class from which all objects in a Document inherit.
 *
 * @property-read Attr[] $attributes
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
 * @property-read StringMap $dataset
 *
 * @property bool allowfullscreen
 * @property bool allowpaymentrequest
 * @property bool async
 * @property bool autocapitalize
 * @property bool autocomplete
 * @property bool autofocus
 * @property bool autoplay
 * @property bool checked Indicates whether the element is checked or not
 * @property bool contentEditable
 * @property bool controls
 * @property bool default
 * @property bool defer
 * @property bool disabled
 * @property bool formnovalidate
 * @property bool hidden
 * @property bool ismap
 * @property bool loop
 * @property bool multiple
 * @property bool muted
 * @property bool novalidate
 * @property bool open
 * @property bool optimum
 * @property bool preload
 * @property bool readonly
 * @property bool required
 * @property bool reversed
 * @property bool selected Indicates whether the element is selected or not
 * @property bool typemustmatch
 *
 * @property string accept
 * @property string acceptCharset
 * @property string accessKey
 * @property string action
 * @property string alt
 * @property string charset
 * @property string cite
 * @property string cols
 * @property string data
 * @property string dateTime
 * @property string dir
 * @property string download
 * @property string encoding
 * @property string enctype
 * @property string form
 * @property string height
 * @property string high
 * @property string htmlFor
 * @property string href
 * @property string kind
 * @property string label
 * @property string lang
 * @property string low
 * @property string min
 * @property string max
 * @property string maxLength
 * @property string mediaGroup
 * @property string name
 * @property string pattern
 * @property string placeholder
 * @property string poster
 * @property string readOnly
 * @property string rel
 * @property string rows
 * @property string start
 * @property string step
 * @property string style
 * @property string size
 * @property string span
 * @property string src
 * @property string srcset
 * @property string tabindex
 * @property string target
 * @property string title
 * @property string type
 * @property string width
 * @property string wrap
 *
 * @method Attr setAttribute(string $name, string $value)
 * @method Attr setAttributeNode(DOMAttr $attr)
 * @method Attr getAttributeNode(string $name)
 */
class Element extends DOMElement {
	use LiveProperty, NonDocumentTypeChildNode, ChildNode, ParentNode;

	const VALUE_ELEMENTS = ["BUTTON", "INPUT", "METER", "OPTION", "PROGRESS", "PARAM"];
	const BOOLEAN_ATTRIBUTES = [
		"allowfullscreen",
		"allowpaymentrequest",
		"async",
		"autofocus",
		"autoplay",
		"checked",
		"controls",
		"default",
		"defer",
		"disabled",
		"formnovalidate",
		"hidden",
		"ismap",
		"loop",
		"multiple",
		"muted",
		"novalidate",
		"open",
		"readonly",
		"required",
		"reversed",
		"selected",
		"typemustmatch",
	];

	/** @var TokenList */
	protected $liveProperty_classList;
	/** @var StringMap */
	protected $liveProperty_dataset;
	/** @var ?DateTime */
	protected $liveProperty_valueAsDate;
	/** @var ?float */
	protected $liveProperty_valueAsNumber;
	/**
	 * @const Array
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement#Elements_that_are_considered_form_controls
	 */
	const FORM_CONTROL_ELEMENTS = ['button', 'fieldset', 'input', 'object', 'output', 'select', 'textarea'];

	/**
	 * returns true if the element would be selected by the specified selector
	 * string; otherwise, returns false.
	 * @param string $selectors The CSS selector(s) to check against
	 * @return bool True if this element is selectable by provided selector
	 */
	public function matches(string $selectors):bool {
		$matches = $this->getRootDocument()->querySelectorAll($selectors);
		$i = $matches->length;
		/** @noinspection PhpStatementHasEmptyBodyInspection */
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

	#[ReturnTypeWillChange]
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

		if(in_array(strtoupper($this->tagName), self::VALUE_ELEMENTS)) {
			return $this->getAttribute("value");
		}

		return null;
	}

	public function prop_set_value(string $newValue) {
		$methodName = 'value_set_' . $this->tagName;
		if(method_exists($this, $methodName)) {
			return $this->$methodName($newValue);
		}

		$this->setAttribute("value", $newValue);
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
		while($this->firstChild) {
			$this->removeChild($this->firstChild);
		}

		if($html === "") {
			return;
		}

		$importDocument = new DOMDocument(
			"1.0",
			"utf-8"
		);

		$htmlWrapped = "<!doctype html><html><body>$html</body></html>";
        $convmap = [0x80, 0x10FFFF, 0, 0x1FFFFF];
        $htmlWrapped = mb_encode_numericentity(
            $htmlWrapped,
            $convmap,
            'UTF-8'
        );

		$importDocument->loadHTML($htmlWrapped);
		$importBody = $importDocument->getElementsByTagName(
			"body"
		)->item(0);
		$node = $this->ownerDocument->importNode(
			$importBody,
			true
		);

		$fragment = $this->ownerDocument->createDocumentFragment();
		while($node->firstChild) {
			$fragment->appendChild($node->firstChild);
		}

		$this->appendChild($fragment);
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

	public function prop_get_dataset():StringMap {
		if(empty($this->liveProperty_dataset)) {
			$this->liveProperty_dataset = $this->createDataset();
		}

		return $this->liveProperty_dataset;
	}

	public function prop_get_checked():bool {
		return $this->hasAttribute("checked");
	}

	public function prop_set_checked(bool $checked):bool {
		if($checked) {
			if($this->getAttribute("type") === "radio") {
// TODO: Use `form` attribute when implemented: https://github.com/PhpGt/Dom/issues/161
				$parentForm = $this->closest("form");
				if(!is_null($parentForm)) {
					$this->removeAttributeFromNamedElementAndChildren(
						$parentForm,
						$this->getAttribute("name"),
						"checked"
					);
				}
			}

			$this->setAttribute("checked", "checked");
		}
		else {
			$this->removeAttribute("checked");
		}

		return $this->checked;
	}

	public function prop_get_selected():bool {
		return $this->hasAttribute("selected");
	}

	public function prop_set_selected(bool $selected):bool {
		if($selected) {
			$selectElement = $this->closest("select");
			if(!$selectElement->hasAttribute("multiple")) {
				$this->removeAttributeFromNamedElementAndChildren(
					$selectElement->closest("form"),
					$selectElement->getAttribute("name"),
					"selected"
				);
			}

			$this->setAttribute("selected", true);
		}
		else {
			$this->removeAttribute("selected");
		}

		return $this->selected;
	}

	public function prop_get_form() {
		if(in_array($this->tagName, self::FORM_CONTROL_ELEMENTS)) {
			if($this->tagName === "input"
			&& $this->getAttribute("type") === "image") {
				return null;
			}

			if($this->hasAttribute("form")) {
				return $this->getRootDocument()->getElementById(
					$this->getAttribute("form")
				);
			}
			else {
				return $this->closest('form');
			}
		}

		return null;
	}

	public function prop_get_valueAsDate() {
		if($this->tagName === "input") {
			return new DateTime($this->value);
		}
	}

	public function prop_get_valueAsNumber() {
		if($this->tagName === "input") {
			return (float)$this->value;
		}
	}

	protected function createDataset():StringMap {
		return new StringMap(
			$this,
			$this->attributes
		);
	}

	protected function getRootDocument():Document {
		return $this->ownerDocument;
	}

	private function getBooleanAttribute(string $attribute):bool {
		return $this->hasAttribute($attribute);
	}

	private function setBooleanAttribute(string $attribute, bool $value) {
		if(($this->tagName === "input" && $this->type === "radio" && $attribute === "checked")
		|| ($this->tagName === "option" && !$this->parentNode->hasAttribute("multiple")) && $attribute === "selected") {
			if($form = $this->closest("form")) {
				$elementName = $this->getAttribute("name");
				if(!$elementName && $this->tagName === "option") {
					$elementName = $this->parentNode->getAttribute("name");
				}

				$this->removeAttributeFromNamedElementAndChildren(
					$form,
					$elementName,
					$attribute
				);
			}
		}
		if($value) {
			$this->setAttribute($attribute, $attribute);
		}
		else {
			$this->removeAttribute($attribute);
		}
	}

	private function value_set_select(string $newValue):void {
		$options = $this->getElementsByTagName('option');
		$selectedIndexes = [];
		$newSelectedIndex = null;

		for($i = $options->length - 1; $i >= 0; --$i) {
			$option = $options->item($i);

			if($this->isSelectOptionSelected($option)) {
				$selectedIndexes []= $i;
			}

			if($option->hasAttribute("value")) {
				if($option->getAttribute("value") == $newValue) {
					$newSelectedIndex = $i;
				}
			}
			else {
				if(trim($option->innerText) === $newValue) {
					$newSelectedIndex = $i;
				}
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
			if($this->isSelectOptionSelected($option)) {
				$value = $option->getAttribute('value')
					?? trim($option->innerText);
				break;
			}
		}

		return $value ?? "";
	}

	private function value_set_input(string $newValue) {
		return $this->setAttribute("value", $newValue);
	}

	private function value_get_input() {
		return $this->getAttribute("value");
	}

	private function value_set_textarea(string $newValue) {
		$this->innerHTML = $newValue;
		return $this->innerHTML;
	}

	private function value_get_textarea() {
		return $this->innerHTML;
	}

	public function isSelectOptionSelected(Element $option) {
		return $option->hasAttribute('selected') && $option->getAttribute('selected');
	}

	public function __debugInfo() {
		return [
			'nodeName' => $this->nodeName,
			'nodeValue' => $this->nodeValue,
			'innerHTML' => $this->innerHTML,
			"class" => $this->className,
			"id" => $this->id,
			"name" => $this->getAttribute("name"),
			"type" => $this->getAttribute("type"),
			"src" => $this->getAttribute("src"),
			"href" => $this->getAttribute("href"),
		];
	}
}
