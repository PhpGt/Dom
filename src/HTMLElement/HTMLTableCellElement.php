<?php
namespace Gt\Dom\HTMLElement;

/**
 * The HTMLTableCellElement interface provides special properties and methods
 * (beyond the regular HTMLElement interface it also has available to it by
 * inheritance) for manipulating the layout and presentation of table cells,
 * either header or data cells, in an HTML document.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableCellElement
 *
 * @property string $abbr A DOMString which can be used on <th> elements (not on <td>), specifying an alternative label for the header cell. This alternate label can be used in other contexts, such as when describing the headers that apply to a data cell. This is used to offer a shorter term for use by screen readers in particular, and is a valuable accessibility tool. Usually the value of abbr is an abbreviation or acronym, but can be any text that's appropriate contextually.
 * @property-read int $cellIndex A long integer representing the cell's position in the cells collection of the <tr> the cell is contained within. If the cell doesn't belong to a <tr>, it returns -1.
 * @property int $colSpan An unsigned long integer indicating the number of columns this cell must span; this lets the cell occupy space across multiple columns of the table. It reflects the colspan attribute.
 * @property string $headers Is a DOMSettableTokenList describing a list of id of <th> elements that represents headers associated with the cell. It reflects the headers attribute.
 * @property int $rowSpan An unsigned long integer indicating the number of rows this cell must span; this lets a cell occupy space across multiple rows of the table. It reflects the rowspan attribute.
 * @property string $scope A DOMString indicating the scope of a <th> cell. Header cells can be configured, using the scope property, the apply to a specified row or column, or to the not-yet-scoped cells within the current row group (that is, the same ancestor <thead>, <tbody>, or <tfoot> element). If no value is specified for scope, the header is not associated directly with cells in this way.
 */
class HTMLTableCellElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableCellElement/abbr */
	protected function __prop_get_abbr():string {
		return $this->getAttribute("abbr") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableCellElement/abbr */
	protected function __prop_set_abbr(string $value):void {
		$this->setAttribute("abbr", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableCellElement/cellIndex */
	protected function __prop_get_cellIndex():int {
		if(!$this->parentElement instanceof HTMLTableRowElement) {
			return -1;
		}

		foreach($this->parentElement->children as $i => $child) {
			if($child === $this) {
				break;
			}
		}

		return $i;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableCellElement/colspan */
	protected function __prop_get_colSpan():int {
		if($this->hasAttribute("colspan")) {
			return (int)$this->getAttribute("colspan");
		}

		return 1;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableCellElement/colspan */
	protected function __prop_set_colSpan(int $value):void {
		$this->setAttribute("colspan", (string)$value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableCellElement/headers */
	protected function __prop_get_headers():string {
// Note that even though the documentation states DOMSettableTokenList, this
// function does indeed return a standard string, in all modern browsers.
		return $this->getAttribute("headers") ?? "";
	}

	public function __prop_set_headers(string $value):void {
		$this->setAttribute("headers", $value);
	}

	protected function __prop_get_rowSpan():int {
		if($this->hasAttribute("rowspan")) {
			return (int)$this->getAttribute("rowspan");
		}

		return 1;
	}

	protected function __prop_set_rowSpan(int $value):void {
		$this->setAttribute("rowspan", (string)$value);
	}

	protected function __prop_get_scope():string {

	}

	protected function __prop_set_scope(string $value):void {

	}
}
