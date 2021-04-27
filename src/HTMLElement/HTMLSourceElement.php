<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLSourceElement interface provides special properties (beyond the
 * regular HTMLElement object interface it also has available to it by
 * inheritance) for manipulating <source> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSourceElement
 *
 * @property string $media Is a DOMString reflecting the media HTML attribute, containing the intended type of the media resource.
 * @property string $sizes Is a DOMString representing image sizes between breakpoints.
 * @property string $src Is a DOMString reflecting the src HTML attribute, containing the URL for the media resource. The HTMLSourceElement.src property has a meaning only when the associated <source> element is nested in a media element that is a <video> or an <audio> element. It has no meaning and is ignored when it is nested in a <picture> element.
 * @property string $srcset Is a DOMString reflecting the srcset HTML attribute, containing a list of candidate images, separated by a comma (',', U+002C COMMA). A candidate image is a URL followed by a 'w' with the width of the images, or an 'x' followed by the pixel density.
 * @property string $type Is a DOMString reflecting the type HTML attribute, containing the type of the media resource.
 */
class HTMLSourceElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSourceElement/media */
	protected function __prop_get_media():string {
		return $this->getAttribute("media") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSourceElement/media */
	protected function __prop_set_media(string $value):void {
		$this->setAttribute("media", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSourceElement/sizes */
	protected function __prop_get_sizes():string {
		return $this->getAttribute("sizes") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSourceElement/sizes */
	protected function __prop_set_sizes(string $value):void {
		$this->setAttribute("sizes", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSourceElement/src */
	protected function __prop_get_src():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSourceElement/src */
	protected function __prop_set_src(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSourceElement/srcset */
	protected function __prop_get_srcset():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSourceElement/srcset */
	protected function __prop_set_srcset(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSourceElement/type */
	protected function __prop_get_type():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSourceElement/type */
	protected function __prop_set_type(string $value):void {

	}
}
