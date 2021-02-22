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
 * @property string $poster Is a DOMString that reflects the poster HTML attribute, which specifies an image to show while no video data is available.
 */
class HTMLVideoElement extends HTMLMediaElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLVideoElement/poster */
	protected function __prop_get_poster():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLVideoElement/poster */
	protected function __prop_set_poster(string $value):void {

	}
}
