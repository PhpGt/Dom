<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\Element;
use Gt\Dom\Exception\EnumeratedValueException;
use Gt\Dom\Exception\FunctionalityNotAvailableOnServerException;
use Gt\Dom\Facade\NodeIteratorFactory;
use Gt\Dom\Facade\TreeWalkerFactory;
use Gt\Dom\HTMLDocument;
use Gt\Dom\NodeFilter;

/**
 * The HTMLElement interface represents any HTML element. Some elements directly
 * implement this interface, while others implement it via an interface that
 * inherits it.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement
 *
 * @property string $accessKey Is a DOMString representing the access key assigned to the element.
 * @property-read string $accessKeyLabel Returns a DOMString containing the element's assigned access key.
 * @property string $contentEditable Is a DOMString, where a value of true means the element is editable and a value of false means it isn't.
 * @property-read bool $isContentEditable Returns a Boolean that indicates whether or not the content of the element can be edited.
 * @property string $dir Is a DOMString, reflecting the dir global attribute, representing the directionality of the element. Possible values are "ltr", "rtl", and "auto".
 * @property bool $draggable Is a Boolean indicating if the element can be dragged.
 * @property string $enterKeyHint Is a DOMString defining what action label (or icon) to present for the enter key on virtual keyboards.
 * @property bool $hidden Is a Boolean indicating if the element is hidden or not.
 * @property bool $inert Is a Boolean indicating whether the user agent must act as though the given node is absent for the purposes of user interaction events, in-page text searches ("find in page"), and text selection.
 * @property string $innerText Represents the "rendered" text content of a node and its descendants. As a getter, it approximates the text the user would get if they highlighted the contents of the element with the cursor and then copied it to the clipboard.
 * @property string $lang Is a DOMString representing the language of an element's attributes, text, and element contents.
 * @property int $tabIndex Is a long that represents this element's position in the tabbing order.
 * @property string $title Is a DOMString containing the text that appears in a popup box when mouse is over the element.
 * Inherited properties with extended types:
 * @property-read HTMLDocument $ownerDocument
 */
abstract class HTMLElement extends Element {
	use HTMLOrForeignElement;
	use ElementCSSInlineStyle;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/accessKey */
	protected function __prop_get_accessKey():string {
		return $this->getAttribute("accesskey") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/accessKey */
	protected function __prop_set_accessKey(string $value):void {
		$this->setAttribute("accesskey", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/accessKeyLabel */
	protected function __prop_get_accessKeyLabel():string {
		throw new FunctionalityNotAvailableOnServerException();
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/contentEditable */
	protected function __prop_get_contentEditable():string {
		$attr = $this->getAttribute("contenteditable");
		return $attr ?: "inherit";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/contentEditable */
	protected function __prop_set_contentEditable(string $value):void {
		switch($value) {
		case "true":
		case "false":
		case "inherit":
			$this->setAttribute("contenteditable", $value);
			break;
		default:
			throw new EnumeratedValueException($value);
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/isContentEditable */
	protected function __prop_get_isContentEditable():bool {
		$attr = $this->getAttribute("contenteditable");
		if(!$attr || $attr === "false") {
			return false;
		}

		if($attr === "true") {
			return true;
		}

		$context = $this;
		while($parent = $context->parentElement) {
			$parentAttr = $parent->getAttribute("contenteditable");
			if($parentAttr === "true") {
				return true;
			}
			if($parentAttr === "false") {
				return false;
			}

			$context = $parent;
		}

		return false;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/dir */
	protected function __prop_get_dir():string {
		return $this->getAttribute("dir") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/dir */
	protected function __prop_set_dir(string $value):void {
		$this->setAttribute("dir", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/draggable */
	protected function __prop_get_draggable():bool {
		$attr = $this->getAttribute("draggable");
		return !is_null($attr) && $attr === "true";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/draggable */
	protected function __prop_set_draggable(bool $value):void {
		$strValue = $value ? "true" : "false";
		$this->setAttribute("draggable", $strValue);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/enterKeyHint */
	protected function __prop_get_enterKeyHint():string {
		return $this->getAttribute("enterkeyhint") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/enterKeyHint */
	protected function __prop_set_enterKeyHint(string $value):void {
		switch($value) {
		case "enter":
		case "done":
		case "go":
		case "next":
		case "previous":
		case "search":
		case "send":
			$this->setAttribute("enterkeyhint", $value);
			break;

		default:
			throw new EnumeratedValueException($value);
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/hidden */
	protected function __prop_get_hidden():bool {
		return $this->hasAttribute("hidden");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/hidden */
	protected function __prop_set_hidden(bool $value):void {
		if($value) {
			$this->setAttribute("hidden", "");
		}
		else {
			$this->removeAttribute("hidden");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/inert */
	protected function __prop_get_inert():bool {
		return $this->hasAttribute("inert");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/inert */
	protected function __prop_set_inert(bool $value):void {
		if($value) {
			$this->setAttribute("inert", "");
		}
		else {
			$this->removeAttribute("inert");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/innerText */
	protected function __prop_get_innerText():string {
		$treeWalker = $this->ownerDocument->createTreeWalker(
			$this,
			NodeFilter::SHOW_TEXT
		);

		$textArray = [];

		foreach($treeWalker as $i => $node) {
			if($i === 0) {
				// Skip the root node.
				continue;
			}

			$parentElement = $node->parentElement;
			$closestHidden = $parentElement->closest("[hidden]");
			if($parentElement
			&& $closestHidden) {
				continue;
			}

			array_push($textArray, $node->textContent);
		}

		return implode("", $textArray);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/innerText */
	protected function __prop_set_innerText(string $value):void {
		$this->textContent = $value;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/lang */
	protected function __prop_get_lang():string {
		return $this->getAttribute("lang") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/lang */
	protected function __prop_set_lang(string $value):void {
		$this->setAttribute("lang", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOrForeignElement/tabIndex */
	protected function __prop_get_tabIndex():int {
		return $this->getAttribute("tabindex") ?? -1;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOrForeignElement/tabIndex */
	protected function __prop_set_tabIndex(int $value):void {
		$this->setAttribute("tabindex", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/title */
	protected function __prop_get_title():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/title */
	protected function __prop_set_title(string $value):void {

	}
}
