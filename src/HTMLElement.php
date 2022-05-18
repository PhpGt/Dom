<?php
namespace Gt\Dom;

use Gt\Dom\ClientSide\CSSStyleDeclaration;
use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;
use Gt\Dom\Exception\IncorrectHTMLElementUsageException;

/**
 * The DOM object model is a strange design, made even stranger by the libxml
 * implementation used by PHP. In order for this library to take advantage of
 * the highly optimised speed of libxml, the classes registered as "node
 * classes" from Document::registerNodeClasses all have to extend the base
 * DOMNode classes, but cannot extend each other. Therefore, even though a
 * DOMElement extends a DOMNode, and a Gt\Dom\Element extends DOMElement and a
 * Gt\Dom\Node extends a DOMNode, it is in fact impossible for a Gt\Dom\Element
 * to extend a Gt\Dom\Node.
 *
 * This is all handled by the underlying implementation, so there is not really
 * any downside, apart from the hierarchy being confusing. What is limited
 * however is the lack of HTMLElement classes that specify the individual
 * functionality of each type of HTML Element - for example, a HTMLSelectElement
 * has a property "options" which contains a list of HTMLOptionElements - this
 * property doesn't make sense to be available to all Elements, so this trait
 * works as a compromise.
 *
 * The intention is to provide IDEs with well-typed autocompletion, but without
 * straying too far from the official specification. This trait contains all
 * functionality introduced by all HTMLElement subtypes, but before each
 * property or method is called, a list of "allowed" Elements is checked,
 * throwing a IncorrectHTMLElementUsageException if incorrectly used.
 *
 * @property string $hreflang Is a DOMString that reflects the hreflang HTML attribute, indicating the language of the linked resource.
 * @property string $text Is a DOMString being a synonym for the Node.textContent property.
 * @property string $type Is a DOMString that reflects the type HTML attribute, indicating the MIME type of the linked resource.
 * @property string $name Is a DOMString representing the name of the object when submitted with a form. If specified, it must not be the empty string.
 * @property bool $checked Returns / Sets the current state of the element when type is checkbox or radio.
 */
trait HTMLElement {
	private function allowTypes(ElementType...$typeList):void {
		if(!in_array($this->elementType, $typeList)) {
			$debug = debug_backtrace(limit: 2);
			$function = $debug[1]["function"];
			if(str_starts_with($function, "__prop")) {
				$funcProp = "Property";
				$funcPropName = substr($function, strlen("__prop_get_"));
			}
			else {
				$funcProp = "Function";
				$funcPropName = $function;
			}

			/** @var Element $object */
			$object = $debug[1]["object"];
			$actualType = $object->elementType->name;
			throw new IncorrectHTMLElementUsageException("$funcProp '$funcPropName' is not available on '$actualType'");
		}
	}
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/style */
	protected function __prop_get_style():CSSStyleDeclaration {
		return new CSSStyleDeclaration();
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/style */
	protected function __prop_set_style(CSSStyleDeclaration $value):void {
		throw new ClientSideOnlyFunctionalityException();
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hreflang */
	protected function __prop_get_hreflang():string {
		$this->allowTypes(ElementType::HTMLAnchorElement);
		return $this->getAttribute("hreflang") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hreflang */
	protected function __prop_set_hreflang(string $value):void {
		$this->allowTypes(ElementType::HTMLAnchorElement);
		$this->setAttribute("hreflang", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/text */
	protected function __prop_get_text():string {
		$this->allowTypes(ElementType::HTMLAnchorElement);
		return $this->textContent;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/text */
	protected function __prop_set_text(string $value):void {
		$this->allowTypes(ElementType::HTMLAnchorElement);
		$this->textContent = $value;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/type */
	protected function __prop_get_type():string {
		$this->allowTypes(ElementType::HTMLAnchorElement, ElementType::HTMLInputElement);
		return $this->getAttribute("type") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/type */
	protected function __prop_set_type(string $value):void {
		$this->allowTypes(ElementType::HTMLAnchorElement, ElementType::HTMLInputElement);
		$this->setAttribute("type", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement/name */
	protected function __prop_get_name():string {
		$this->allowTypes(ElementType::HTMLInputElement);
		return $this->getAttribute("name") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement/name */
	protected function __prop_set_name(string $value):void {
		$this->allowTypes(ElementType::HTMLInputElement);
		$this->setAttribute("name", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement/value */
	protected function __prop_get_value():string {
		$this->allowTypes(ElementType::HTMLInputElement);
		$value = $this->getAttribute("value");
		if(!is_null($value)) {
			return $value;
		}

		if($this->elementType === ElementType::HTMLSelectElement) {
			if($this->selectedIndex === -1) {
				return "";
			}

			return $this->options[$this->selectedIndex]->value;
		}

		return $this->textContent;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement/value */
	protected function __prop_set_value(string $value):void {
		$this->allowTypes(ElementType::HTMLInputElement);
		$this->setAttribute("value", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement#checked */
	protected function __prop_get_checked():bool {
		$this->allowTypes(ElementType::HTMLInputElement);
		return $this->hasAttribute("checked");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement#checked */
	protected function __prop_set_checked(bool $value):void {
		$this->allowTypes(ElementType::HTMLInputElement);
		if($value) {
			$this->setAttribute("checked", "");
		}
		else {
			$this->removeAttribute("checked");
		}
	}
}
