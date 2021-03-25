<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLVideoElement interface provides special properties and methods for
 * manipulating video objects. It also inherits properties and methods of
 * HTMLMediaElement and HTMLElement.
 *
 * The list of supported media formats varies from one browser to the other.
 * You should either provide your video in a single format that all the relevant
 * browsers supports, or provide multiple video sources in enough different
 * formats that all the browsers you need to support are covered.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLVideoElement
 *
 * @property string $height Is a DOMString that reflects the height HTML attribute, which specifies the height of the display area, in CSS pixels.
 * @property string $poster Is a DOMString that reflects the poster HTML attribute, which specifies an image to show while no video data is available.
 * @property-read int $videoHeight Returns an unsigned integer value indicating the intrinsic height of the resource in CSS pixels, or 0 if no media is available yet.
 * @property-read int $videoWidth Returns an unsigned integer value indicating the intrinsic width of the resource in CSS pixels, or 0 if no media is available yet.
 * @property string $width Is a DOMString that reflects the width HTML attribute, which specifies the width of the display area, in CSS pixels.
 */
class HTMLVideoElement extends HTMLMediaElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLVideoElement/height */
	protected function __prop_get_height():string {
		return $this->getAttribute("height") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLVideoElement/height */
	protected function __prop_set_height(string $value):void {
		$this->setAttribute("height", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLVideoElement/poster */
	protected function __prop_get_poster():string {
		return $this->getAttribute("poster") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLVideoElement/poster */
	protected function __prop_set_poster(string $value):void {
		$this->setAttribute("poster", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLVideoElement/videoHeight */
	protected function __prop_get_videoHeight():int {
		return 0;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLVideoElement/videoWidth */
	protected function __prop_get_videoWidth():int {
		return 0;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLVideoElement/width */
	protected function __prop_get_width():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLVideoElement/width */
	protected function __prop_set_width(string $value):void {

	}
}
