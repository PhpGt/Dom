<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLCanvasElement interface provides properties and methods for
 * manipulating the layout and presentation of <canvas> elements. The
 * HTMLCanvasElement interface also inherits the properties and methods of the
 * HTMLElement interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLCanvasElement
 *
 * @property int $height The height HTML attribute of the <canvas> element is a positive integer reflecting the number of logical pixels (or RGBA values) going down one column of the canvas. When the attribute is not specified, or if it is set to an invalid value, like a negative, the default value of 150 is used. If no [separate] CSS height is assigned to the <canvas>, then this value will also be used as the height of the canvas in the length-unit CSS Pixel.
 * @property int $width The width HTML attribute of the <canvas> element is a positive integer reflecting the number of logical pixels (or RGBA values) going across one row of the canvas. When the attribute is not specified, or if it is set to an invalid value, like a negative, the default value of 300 is used. If no [separate] CSS width is assigned to the <canvas>, then this value will also be used as the width of the canvas in the length-unit CSS Pixel.
 */
class HTMLCanvasElement extends HTMLElement {
	const DEFAULT_WIDTH = 300;
	const DEFAULT_HEIGHT = 150;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLCanvasElement/height */
	protected function __prop_get_height():int {
		return $this->getAttribute("height")
			?? self::DEFAULT_HEIGHT;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLCanvasElement/height */
	protected function __prop_set_height(int $value):void {
		$this->setAttribute("height", (string)$value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLCanvasElement/width */
	protected function __prop_get_width():int {
		return $this->getAttribute("width")
			?? self::DEFAULT_WIDTH;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLCanvasElement/width */
	protected function __prop_set_width(int $value):void {
		$this->setAttribute("width", (string)$value);
	}
}
