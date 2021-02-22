<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\DOMStringMap;

/**
 * @property-read DOMStringMap $dataset The dataset read-only property of the HTMLOrForeignElement mixin provides read/write access to custom data attributes (data-*) on elements.
 * @property int $tabIndex The tabIndex property of the HTMLOrForeignElement mixin represents the tab order of the current element.
 */
trait HTMLOrForeignElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOrForeignElement/dataset */
	protected function __prop_get_dataset():DOMStringMap {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOrForeignElement/tabIndex */
	protected function __prop_get_tabIndex():int {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLOrForeignElement/tabIndex */
	protected function __prop_set_tabIndex(int $tabIndex):void {

	}
}
