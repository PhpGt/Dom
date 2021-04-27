<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLStyleElement interface represents a <style> element. It inherits
 * properties and methods from its parent, HTMLElement, and from LinkStyle.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLStyleElement
 *
 * @property string $media Is a DOMString representing the intended destination medium for style information.
 * @property string $type Is a DOMString representing the type of style being applied by this statement.
 * @property bool $disabled Is a Boolean value representing whether or not the stylesheet is disabled (true) or not (false).
 * @property-read StyleSheet $sheet Returns the StyleSheet object associated with the given element, or null if there is none
 *
 */
class HTMLStyleElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLStyleElement/media */
	protected function __prop_get_media():string {
		return $this->getAttribute("media") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLStyleElement/media */
	protected function __prop_set_media(string $value):void {
		$this->setAttribute("media", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLStyleElement/type */
	protected function __prop_get_type():string {
		return $this->getAttribute("type") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLStyleElement/type */
	protected function __prop_set_type(string $value):void {
		$this->setAttribute("type", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLStyleElement/disabled */
	protected function __prop_get_disabled():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLStyleElement/disabled */
	protected function __prop_set_disabled(bool $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLStyleElement/sheet */
	protected function __prop_get_sheet():StyleSheet {

	}

}
