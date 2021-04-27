<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLTrackElement interface represents an HTML <track> element within the
 * DOM. This element can be used as a child of either <audio> or <video> to
 * specify a text track containing information such as closed captions or
 * subtitles.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTrackElement
 *
 * @property string $kind Is a DOMString that reflects the kind HTML attribute, indicating how the text track is meant to be used. Possible values are: subtitles, captions, descriptions, chapters, or metadata.
 * @property string $src Is a DOMString that reflects the src HTML attribute, indicating the address of the text track data.
 * @property string $srclang Is a DOMString that reflects the srclang HTML attribute, indicating the language of the text track data.
 * @property string $label Is a DOMString that reflects the label HTML attribute, indicating a user-readable title for the track.
 * @property bool $default A Boolean reflecting the default  attribute, indicating that the track is to be enabled if the user's preferences do not indicate that another track would be more appropriate.
 * @property-read int $readyState Returns  an unsigned short that show the readiness state of the track (always 0 on the server).
 * @property-read TextTrack $track Returns TextTrack is the track element's text track data.
 */
class HTMLTrackElement extends HTMLElement {
	protected function __prop_get_kind():string {
		return $this->getAttribute("kind") ?? "";
	}

	protected function __prop_set_kind(string $value):void {
		$this->setAttribute("kind", $value);
	}

	protected function __prop_get_src():string {
		return $this->getAttribute("src") ?? "";
	}

	protected function __prop_set_src(string $value):void {
		$this->setAttribute("src", $value);
	}

	protected function __prop_get_srclang():string {
		return $this->getAttribute("srclang") ?? "";
	}

	protected function __prop_set_srclang(string $value):void {
		$this->setAttribute("srclang", $value);
	}

	protected function __prop_get_label():string {
		return $this->getAttribute("label") ?? "";
	}

	protected function __prop_set_label(string $value):void {
		$this->setAttribute("label", $value);
	}

	protected function __prop_get_default():bool {

	}

	protected function __prop_set_default(bool $value):void {

	}

	protected function __prop_get_readyState():int {

	}

	protected function __prop_get_track():TextTrack {

	}
}
