<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\HTMLCollection;

/**
 * The HTMLTableElement interface provides special properties and methods
 * (beyond the regular HTMLElement object interface it also has available to it
 * by inheritance) for manipulating the layout and presentation of tables in an
 * HTML document.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement
 *
 * @property ?HTMLTableCaptionElement $caption Is a HTMLTableCaptionElement representing the first <caption> that is a child of the element, or null if none is found. When set, if the object doesn't represent a <caption>, a DOMException with the HierarchyRequestError name is thrown. If a correct object is given, it is inserted in the tree as the first child of this element and the first <caption> that is a child of this element is removed from the tree, if any.
 * @property ?HTMLTableSectionElement $tHead Is a HTMLTableSectionElement representing the first <thead> that is a child of the element, or null if none is found. When set, if the object doesn't represent a <thead>, a DOMException with the HierarchyRequestError name is thrown. If a correct object is given, it is inserted in the tree immediately before the first element that is neither a <caption>, nor a <colgroup>, or as the last child if there is no such element, and the first <thead> that is a child of this element is removed from the tree, if any.
 * @property ?HTMLTableSectionElement $tFoot Is a HTMLTableSectionElement representing the first <tfoot> that is a child of the element, or null if none is found. When set, if the object doesn't represent a <tfoot>, a DOMException with the HierarchyRequestError name is thrown. If a correct object is given, it is inserted in the tree immediately before the first element that is neither a <caption>, a <colgroup>, nor a <thead>, or as the last child if there is no such element, and the first <tfoot> that is a child of this element is removed from the tree, if any.
 * @property-read HTMLCollection $rows Returns a live HTMLCollection containing all the rows of the element, that is all <tr> that are a child of the element, or a child of one of its <thead>, <tbody> and <tfoot> children. The rows members of a <thead> appear first, in tree order, and those members of a <tbody> last, also in tree order. The HTMLCollection is live and is automatically updated when the HTMLTableElement changes.
 * @property-read HTMLCollection $tBodies Returns a live HTMLCollection containing all the <tbody> of the element. The HTMLCollection is live and is automatically updated when the HTMLTableElement changes.
 */
class HTMLTableElement extends HTMLElement {
	/**
	 * Returns an HTMLTableSectionElement representing the first <thead>
	 * that is a child of the element. If none is found, a new one is
	 * created and inserted in the tree immediately before the first element
	 * that is neither a <caption>, nor a <colgroup>, or as the last child
	 * if there is no such element.
	 *
	 * Note: If no header exists, createTHead() inserts a new header
	 * directly into the table. The header does not need to be added
	 * separately as would be the case if Document.createElement() had been
	 * used to create the new <thead> element.
	 *
	 * @return HTMLTableSectionElement
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/createTHead
	 */
	public function createTHead():HTMLTableSectionElement {

	}

	/**
	 * The HTMLTableElement.deleteTHead() removes the <thead> element from
	 * a given <table>.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/deleteTHead
	 */
	public function deleteTHead():void {

	}

	/**
	 * The createTFoot() method of HTMLTableElement objects returns the
	 * <tfoot> element associated with a given <table>. If no footer exists
	 * in the table, this method creates it, and then returns it.
	 *
	 * Note: If no footer exists, createTFoot() inserts a new footer
	 * directly into the table. The footer does not need to be added
	 * separately as would be the case if Document.createElement() had been
	 * used to create the new <tfoot> element.
	 *
	 * @return HTMLTableSectionElement
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/createTFoot
	 */
	public function createTFoot():HTMLTableSectionElement {

	}

	/**
	 * The HTMLTableElement.deleteTFoot() method removes the <tfoot> element
	 * from a given <table>.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/deleteTFoot
	 */
	public function deleteTFoot():void {

	}

	/**
	 * The createTBody() method of HTMLTableElement objects creates and
	 * returns a new <tbody> element associated with a given <table>.
	 *
	 * Note: Unlike HTMLTableElement.createTHead() and
	 * HTMLTableElement.createTFoot(), createTBody() systematically creates
	 * a new <tbody> element, even if the table already contains one or more
	 * bodies. If so, the new one is inserted after the existing ones.
	 *
	 * @return HTMLTableSectionElement
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/createTBody
	 */
	public function createTBody():HTMLTableSectionElement {

	}

	/**
	 * The HTMLTableElement.createCaption() method returns the <caption>
	 * element associated with a given <table>. If no <caption> element
	 * exists on the table, this method creates it, and then returns it.
	 *
	 * Note: If no caption exists, createCaption() inserts a new caption
	 * directly into the table. The caption does not need to be added
	 * separately as would be the case if Document.createElement() had been
	 * used to create the new <caption> element.
	 *
	 * @return HTMLTableCaptionElement
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/createCaption
	 */
	public function createCaption():HTMLTableCaptionElement {

	}

	/**
	 * The HTMLTableElement.deleteCaption() method removes the <caption>
	 * element from a given <table>. If there is no <caption> element
	 * associated with the table, this method does nothing.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/deleteCaption
	 */
	public function deleteCaption():void {

	}

	/**
	 * The HTMLTableElement.insertRow() method inserts a new row (<tr>) in
	 * a given <table>, and returns a reference to the new row.
	 *
	 * If a table has multiple <tbody> elements, by default, the new row is
	 * inserted into the last <tbody>.
	 *
	 * Note: insertRow() inserts the row directly into the table. The row
	 * does not need to be appended separately as would be the case if
	 * Document.createElement() had been used to create the new <tr>
	 * element.
	 *
	 * @param ?int $index The row index of the new row. If index is -1 or
	 * equal to the number of rows, the row is appended as the last row.
	 * If index is greater than the number of rows, an IndexSizeError
	 * exception will result. If index is omitted it defaults to -1.
	 * @return HTMLTableRowElement an HTMLTableRowElement that references
	 * the new row.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/insertRow
	 */
	public function insertRow(int $index = null):HTMLTableRowElement {

	}

	/**
	 * The HTMLTableElement.deleteRow() method removes a specific row (<tr>)
	 * from a given <table>.
	 *
	 * @param int $index index is an integer representing the row that
	 * should be deleted. However, the special index -1 can be used to
	 * remove the very last row of a table.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/deleteRow
	 */
	public function deleteRow(int $index):void {

	}

	protected function __prop_get_caption():?HTMLTableCaptionElement {

	}

	protected function __prop_set_caption(?HTMLTableCaptionElement $value):void {

	}

	protected function __prop_get_tHead():?HTMLTableSectionElement {

	}

	protected function __prop_set_tHead(?HTMLTableSectionElement $value):void {

	}

	protected function __prop_get_tFoot():?HTMLTableSectionElement {

	}

	protected function __prop_set_tFoot(?HTMLTableSectionElement $value):void {

	}

	protected function __prop_get_rows():HTMLCollection {

	}

	protected function __prop_get_tBodies():HTMLCollection {

	}
}
