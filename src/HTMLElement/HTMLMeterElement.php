<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\NodeList;

/**
 * The HTML <meter> elements expose the HTMLMeterElement interface, which
 * provides special properties and methods (beyond the HTMLElement object
 * interface they also have available to them by inheritance) for manipulating
 * the layout and presentation of <meter> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement
 *
 * @property ?float $high A double representing the value of the high boundary, reflecting the high attribute.
 * @property ?float $low A double representing the value of the low boundary, reflecting the lowattribute.
 * @property ?float $max A double representing the maximum value, reflecting the max attribute.
 * @property ?float $min A double representing the minimum value, reflecting the min attribute.
 * @property ?float $optimum A double representing the optimum, reflecting the optimum attribute.
 * @property ?float $value A double representing the currrent value, reflecting the value attribute.
 * @property-read NodeList $labels A NodeList of <label> elements that are associated with the element.
 */
class HTMLMeterElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/high */
	protected function __prop_get_high():?float {
		if($this->hasAttribute("high")) {
			return (float)$this->getAttribute("high");
		}

		return null;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/high */
	protected function __prop_set_high(float $value):void {
		$this->setAttribute("high", (string)$value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/low */
	protected function __prop_get_low():?float {
		if($this->hasAttribute("low")) {
			return (float)$this->getAttribute("low");
		}

		return null;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/low */
	protected function __prop_set_low(float $value):void {
		$this->setAttribute("low", (string)$value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/max */
	protected function __prop_get_max():?float {
		if($this->hasAttribute("max")) {
			return (float)$this->getAttribute("max");
		}

		return null;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/max */
	protected function __prop_set_max(float $value):void {
		$this->setAttribute("max", (string)$value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/min */
	protected function __prop_get_min():float {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/min */
	protected function __prop_set_min(float $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/optimum */
	protected function __prop_get_optimum():float {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/optimum */
	protected function __prop_set_optimum(float $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/value */
	protected function __prop_get_value():float {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/value */
	protected function __prop_set_value(float $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLMeterElement/labels */
	protected function __prop_get_labels():NodeList {

	}
}
