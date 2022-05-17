<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\ClientSide\CSSStyleDeclaration;
use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;

/**
 * The ElementCSSInlineStyle mixin describes CSSOM-specific features common to
 * the HTMLElement, SVGElement and MathMLElement interfaces. Each of these
 * interfaces can, of course, add more features in addition to the ones listed
 * below.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/ElementCSSInlineStyle
 *
 * @property CSSStyleDeclaration $style Is a CSSStyleDeclaration, an object representing the declarations of an element's style attributes.
 */
trait ElementCSSInlineStyle {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/style */
	protected function __prop_get_style():CSSStyleDeclaration {
		return new CSSStyleDeclaration();
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/style */
	protected function __prop_set_style(CSSStyleDeclaration $value):void {
		throw new ClientSideOnlyFunctionalityException();
	}
}
