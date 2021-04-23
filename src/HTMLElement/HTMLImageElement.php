<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLImageElement interface represents an HTML <img> element, providing
 * the properties and methods used to manipulate image elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement
 *
 * @property string $alt A DOMString that reflects the alt HTML attribute, thus indicating the alternate fallback content to be displayed if the image has not been loaded.
 * @property-read bool $complete Returns a Boolean that is true if the browser has finished fetching the image, whether successful or not. That means this value is also true if the image has no src value indicating an image to load.
 * @property string $crossOrigin A DOMString specifying the CORS setting for this image element. See CORS settings attributes for further details. This may be null if CORS is not used.
 * @property-read string $currentSrc Returns a USVString representing the URL from which the currently displayed image was loaded. This may change as the image is adjusted due to changing conditions, as directed by any media queries which are in place.
 * @property string $decoding An optional DOMString representing a hint given to the browser on how it should decode the image. If this value is provided, it must be one of the possible permitted values: sync to decode the image synchronously, async to decode it asynchronously, or auto to indicate no preference (which is the default). Read the decoding page for details on the implications of this property's values.
 * @property int $height An integer value that reflects the height HTML attribute, indicating the rendered height of the image in CSS pixels.
 * @property bool $isMap A Boolean that reflects the ismap HTML attribute, indicating that the image is part of a server-side image map. This is different from a client-side image map, specified using an <img> element and a corresponding <map> which contains <area> elements indicating the clickable areas in the image. The image must be contained within an <a> element; see the ismap page for details.
 * @property string $loading A DOMString providing a hint to the browser used to optimize loading the document by determining whether to load the image immediately (eager) or on an as-needed basis (lazy).
 * @property-read int $naturalHeight Returns an integer value representing the intrinsic height of the image in CSS pixels, if it is available; else, it shows 0. This is the height the image would be if it were rendered at its natural full size.
 * @property-read int $naturalWidth An integer value representing the intrinsic width of the image in CSS pixels, if it is available; otherwise, it will show 0. This is the width the image would be if it were rendered at its natural full size.
 * @property string $referrerPolicy A DOMString that reflects the referrerpolicy HTML attribute, which tells the user agent how to decide which referrer to use in order to fetch the image. Read this article for details on the possible values of this string.
 * @property string $sizes A DOMString reflecting the sizes HTML attribute. This string specifies a list of comma-separated conditional sizes for the image; that is, for a given viewport size, a particular image size is to be used. Read the documentation on the sizes page for details on the format of this string.
 * @property string $src A USVString that reflects the src HTML attribute, which contains the full URL of the image including base URI. You can load a different image into the element by changing the URL in the src attribute.
 * @property string $srcset A USVString reflecting the srcset HTML attribute. This specifies a list of candidate images, separated by commas (',', U+002C COMMA). Each candidate image is a URL followed by a space, followed by a specially-formatted string indicating the size of the image. The size may be specified either the width or a size multiple. Read the srcset page for specifics on the format of the size substring.
 * @property string $useMap A DOMString reflecting the usemap HTML attribute, containing the page-local URL of the <map> element describing the image map to use. The page-local URL is a pound (hash) symbol (#) followed by the ID of the <map> element, such as #my-map-element. The <map> in turn contains <area> elements indicating the clickable areas in the image.
 * @property int $width An integer value that reflects the width HTML attribute, indicating the rendered width of the image in CSS pixels.
 * @property-read int $x An integer indicating the horizontal offset of the left border edge of the image's CSS layout box relative to the origin of the <html> element's containing block.
 * @property-read int $y The integer vertical offset of the top border edge of the image's CSS layout box relative to the origin of the <html> element's containing block.
 */
class HTMLImageElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/alt */
	protected function __prop_get_alt():string {
		return $this->getAttribute("alt") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/alt */
	protected function __prop_set_alt(string $value):void {
		$this->setAttribute("alt", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/complete */
	protected function __prop_get_complete():bool {
		return false;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/crossOrigin */
	protected function __prop_get_crossOrigin():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/crossOrigin */
	protected function __prop_set_crossOrigin(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/currentSrc */
	protected function __prop_get_currentSrc():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/decoding */
	protected function __prop_get_decoding():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/decoding */
	protected function __prop_set_decoding(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/height */
	protected function __prop_get_height():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/height */
	protected function __prop_set_height(int $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/isMap */
	protected function __prop_get_isMap():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/isMap */
	protected function __prop_set_isMap(bool $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/loading */
	protected function __prop_get_loading():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/loading */
	protected function __prop_set_loading(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/naturalHeight */
	protected function __prop_get_naturalHeight():int {
		return 0;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/naturalWidth */
	protected function __prop_get_naturalWidth():int {
		return 0;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/referrerPolicy */
	protected function __prop_get_referrerPolicy():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/referrerPolicy */
	protected function __prop_set_referrerPolicy(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/sizes */
	protected function __prop_get_sizes():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/sizes */
	protected function __prop_set_sizes(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/src */
	protected function __prop_get_src():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/src */
	protected function __prop_set_src(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/srcset */
	protected function __prop_get_srcset():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/srcset */
	protected function __prop_set_srcset(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/useMap */
	protected function __prop_get_useMap():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/useMap */
	protected function __prop_set_useMap(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/width */
	protected function __prop_get_width():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/width */
	protected function __prop_set_width(int $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/x */
	protected function __prop_get_x():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLImageElement/y */
	protected function __prop_get_y():int {

	}
}
