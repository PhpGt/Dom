<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\Exception\FunctionalityNotAvailableOnServerException;
use Gt\Dom\Node;
use Gt\Dom\Document;

/**
 * The HTMLIFrameElement interface provides special properties and methods
 * (beyond those of the HTMLElement interface it also has available to it by
 * inheritance) for manipulating the layout and presentation of inline frame
 * elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement
 *
 * @property-read Document $contentDocument Returns a Document, the active document in the inline frame's nested browsing context.
 * @property-read Node $contentWindow Returns a WindowProxy, the window proxy for the nested browsing context.
 * @property string $height Is a DOMString that reflects the height HTML attribute, indicating the height of the frame.
 * @property string $name Is a DOMString that reflects the name HTML attribute, containing a name by which to refer to the frame.
 * @property string $referrerPolicy Is a DOMString that reflects the referrerpolicy HTML attribute indicating which referrer to use when fetching the linked resource.
 * @property string $src Is a DOMString that reflects the src HTML attribute, containing the address of the content to be embedded. Note that programmatically removing an <iframe>'s src attribute (e.g. via Element.removeAttribute()) causes about:blank to be loaded in the frame in Firefox (from version 65), Chromium-based browsers, and Safari/iOS.
 * @property string $srcdoc Is a DOMString that represents the content to display in the frame.
 * @property string $width Is a DOMString that reflects the width HTML attribute, indicating the width of the frame.
 */
class HTMLIFrameElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/contentDocument */
	protected function __prop_get_contentDocument():Document {
		throw new FunctionalityNotAvailableOnServerException("contentDocument");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/contentWindow */
	protected function __prop_get_contentWindow():Node {
		throw new FunctionalityNotAvailableOnServerException("contentWindow");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/height */
	protected function __prop_get_height():string {
		return $this->getAttribute("height") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/height */
	protected function __prop_set_height(string $value):void {
		$this->setAttribute("height", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/name */
	protected function __prop_get_name():string {
		return $this->getAttribute("name") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/name */
	protected function __prop_set_name(string $value):void {
		$this->setAttribute("name", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/referrerPolicy */
	protected function __prop_get_referrerPolicy():string {
		return $this->getAttribute("referrerpolicy") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/referrerPolicy */
	protected function __prop_set_referrerPolicy(string $value):void {
		$this->setAttribute("referrerpolicy", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/src */
	protected function __prop_get_src():string {
		return $this->getAttribute("src") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/src */
	protected function __prop_set_src(string $value):void {
		$this->setAttribute("src", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/srcdoc */
	protected function __prop_get_srcdoc():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/srcdoc */
	protected function __prop_set_srcdoc(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/width */
	protected function __prop_get_width():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLIFrameElement/width */
	protected function __prop_set_width(int $value):void {

	}
}
