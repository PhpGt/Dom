<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLEmbedElement interface provides special properties (beyond the
 * regular HTMLElement interface it also has available to it by inheritance)
 * for manipulating <embed> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLEmbedElement
 *
 * @property string $height Is a DOMString reflecting the height HTML attribute, containing the displayed height of the resource.
 * @property string $src Is a DOMString that reflects the src HTML attribute, containing the address of the resource.
 * @property string $type Is a DOMString that reflects the type HTML attribute, containing the type of the resource.
 * @property string $width Is a DOMString that reflects the width HTML attribute, containing the displayed width of the resource.
 */
class HTMLEmbedElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLEmbedElement/height */
	protected function __prop_get_height():string {
		return $this->getAttribute("height") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLEmbedElement/height */
	protected function __prop_set_height(string $value):void {
		$this->setAttribute("height", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLEmbedElement/src */
	protected function __prop_get_src():string {
		return $this->getAttribute("src") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLEmbedElement/src */
	protected function __prop_set_src(string $value):void {
		$this->setAttribute("src", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLEmbedElement/type */
	protected function __prop_get_type():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLEmbedElement/type */
	protected function __prop_set_type(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLEmbedElement/width */
	protected function __prop_get_width():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLEmbedElement/width */
	protected function __prop_set_width(int $value):void {

	}
}
