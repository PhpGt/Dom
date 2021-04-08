<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\Exception\HierarchyRequestError;
use Gt\Dom\Exception\IndexSizeException;
use Gt\Dom\Facade\HTMLCollectionFactory;
use Gt\Dom\Facade\NodeListFactory;
use Gt\Dom\HTMLCollection;
use Gt\Dom\Node;

/**
 * The HTMLTableElement interface provides special properties and methods
 * (beyond the regular HTMLElement object interface it also has available to it
 * by inheritance) for manipulating the layout and presentation of tables in an
 * HTML document.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement
 * Note: MDN is not very clear about the order of child elements, especially of tfoot and tbody.
 * According to the HTML5.1 spec:
 * @link https://www.w3.org/TR/html51/tabular-data.html#tabular-data
 * Table content model:
 * In this order: optionally a caption element, followed by zero or more colgroup elements,
 * followed optionally by a thead element, followed by either zero or more tbody elements
 * or one or more tr elements, followed optionally by a tfoot element,
 * optionally intermixed with one or more script-supporting elements.
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
		return $this->getCreateChild('thead');
	}

	/**
	 * The HTMLTableElement.deleteTHead() removes the <thead> element from a given <table>.
	 * The deleteTHead() method must remove the first thead element child of the table element, if any.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/deleteTHead
	 * @link https://html.spec.whatwg.org/multipage/tables.html#dom-table-deletethead
	 */
	public function deleteTHead():void {
		$this->delChild('thead');
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
	 *
	 * For the order of elements @see https://www.w3.org/TR/html51/tabular-data.html#tabular-data
	 */
	public function createTFoot():HTMLTableSectionElement {
		return $this->getCreateChild('tfoot');
	}

	/**
	 * The HTMLTableElement.deleteTFoot() method removes the <tfoot> element
	 * from a given <table>.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/deleteTFoot
	 */
	public function deleteTFoot():void {
		$this->delChild('tfoot');
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
	 * For the order of elements @see https://www.w3.org/TR/html51/tabular-data.html#tabular-data
	 */
	public function createTBody():HTMLTableSectionElement {
		/** @var HTMLTableSectionElement $tbody */
		$tbody = $this->ownerDocument->createElement('tbody');
		$this->placeTBody($tbody);

		return $tbody;
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
		return $this->getCreateChild('caption');
	}

	/**
	 * The HTMLTableElement.deleteCaption() method removes the <caption>
	 * element from a given <table>. If there is no <caption> element
	 * associated with the table, this method does nothing.
	 *
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/deleteCaption
	 */
	public function deleteCaption():void {
		$this->delChild('caption');
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
	 * @link https://html.spec.whatwg.org/multipage/#htmltableelement
	 */
	public function insertRow(int $index = null):HTMLTableRowElement {
		$lastTBody = $this->hasChildLast('tbody');
		$numRow = $this->rows->length;
		/** @var HTMLTableRowElement $row */
		$row = $this->ownerDocument->createElement('tr');
		if($index === null) {
			$index = -1;
		}

// note: for the order of statements @see https://www.w3.org/TR/html52/tabular-data.html#dom-htmltableelement-insertrow
		if($index < -1 || $index > $numRow) {
			throw new IndexSizeException('Row index is outside bounds.');
		}
		elseif($numRow === 0 && $lastTBody === null) {
// note: can't use HTMLTableElement::createTBody() because we need to append row before inserting
			/** @var HTMLTableSectionElement $tbody */
			$tbody = $this->ownerDocument->createElement('tbody');
			$tbody->appendChild($row);
			$this->insertChildAfter($tbody, ['caption', 'colgroup']);
		}
		elseif($numRow === 0) {
			$lastTBody->appendChild($row);
		}
		elseif($index === -1 || $index === $numRow) {
			$lastRow = $this->rows->item($numRow - 1);
			$lastRow->parentNode->appendChild($row);
		}
		else {
			$refNode = $this->rows->item($index);
			$refNode->parentNode->insertBefore($row, $refNode);
		}

		return $row;
	}

	/**
	 * The HTMLTableElement.deleteRow() method removes a specific row (<tr>)
	 * from a given <table>.
	 *
	 * @param int $index index is an integer representing the row that
	 * should be deleted. However, the special index -1 can be used to
	 * remove the very last row of a table.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLTableElement/deleteRow
	 * @link https://html.spec.whatwg.org/multipage/tables.html#dom-table-deleterow
	 */
	public function deleteRow(int $index):void {
// note: for the order of statements @see https://html.spec.whatwg.org/multipage/tables.html#dom-table-rows
		$numRow = $this->rows->length;
		if($index < -1 || $index >= $numRow) {
			throw new IndexSizeException('Row index is outside bounds.');
		}
		elseif($index === -1) {
			if($numRow > 0) {
				$lastRow = $this->rows->item($numRow - 1);
				$lastRow->parentNode->removeChild($lastRow);
			}
		}
		else {
			$row = $this->rows->item($index);
			$row->parentNode->removeChild($row);
		}
	}

	protected function __prop_get_caption():?HTMLTableCaptionElement {
		/**
		 * The caption IDL attribute must return, on getting, the first <caption> element child
		 * of the <table> element, if any, or null otherwise.
		 * @see https://www.w3.org/TR/html52/tabular-data.html#dom-htmltableelement-caption
		 */
		/** @var ?HTMLTableCaptionElement $node */
		$node = $this->hasChildFirst('caption');
		return $node;
	}

	protected function __prop_set_caption(?HTMLTableCaptionElement $value):void {
		/**
		 * On setting, the first <caption> element child of the <table> element, if any, must be removed,
		 * and the new value, if not null, must be inserted as the first node of the <table> element.
		 * @see https://www.w3.org/TR/html52/tabular-data.html#dom-htmltableelement-caption
		 */
		$this->delChild('caption');
		$this->placeCaption($value);
	}

	protected function __prop_get_tHead():?HTMLTableSectionElement {
		/**
		 * The tHead IDL attribute must return, on getting, the first <thead> element child of the <table> element,
		 * if any, or null otherwise.
		 * @see https://www.w3.org/TR/html52/tabular-data.html#dom-htmltableelement-thead
		 */
		/** @var ?HTMLTableSectionElement $node */
		$node = $this->hasChildFirst('thead');
		return $node;
	}

	protected function __prop_set_tHead(?HTMLTableSectionElement $value):void {
		/**
		 * On setting, if the new value is null or a <thead> element,
		 * the first <thead> element child of the <table> element, if any, must be removed, and the new value,
		 * if not null, must be inserted immediately before the first element in the <table> element
		 * that is neither a <caption> element nor a <colgroup> element, if any,
		 * or at the end of the <table> if there are no such elements.
		 * If the new value is neither null nor a <thead> element, then a HierarchyRequestError DOM exception
		 * must be thrown instead.
		 * @see https://www.w3.org/TR/html52/tabular-data.html#dom-htmltableelement-thead
		 */
		if($value !== null && strtolower($value->nodeName) !== 'thead') {
			throw new HierarchyRequestError();
		}
		$this->delChild('thead');
		$this->placeThead($value);
	}

	protected function __prop_get_tFoot():?HTMLTableSectionElement {
		/**
		 * The tFoot IDL attribute must return, on getting, the first tfoot element child of the table element,
		 * if any, or null otherwise.
		 * @see https://www.w3.org/TR/html52/tabular-data.html#dom-htmltableelement-tfoot
		 */
		/** @var ?HTMLTableSectionElement $node */
		$node = $this->hasChildFirst('tfoot');
		return $node;
	}

	protected function __prop_set_tFoot(?HTMLTableSectionElement $value):void {
		/**
		 * On setting, if the new value is null or a tfoot element, the first tfoot element child of the table element,
		 * if any, must be removed, and the new value, if not null, must be inserted at the end of the table.
		 * If the new value is neither null nor a tfoot element,
		 * then a HierarchyRequestError DOM exception must be thrown instead.
		 * @see https://www.w3.org/TR/html52/tabular-data.html#dom-htmltableelement-tfoot
		 */
		if($value !== null && strtolower($value->nodeName) !== 'tfoot') {
			throw new HierarchyRequestError();
		}
		$this->delChild('tfoot');
		$this->placeTFoot($value);
	}

	protected function __prop_get_rows():HTMLCollection {
		return HTMLCollectionFactory::create(function() {
			$rowsHead = [];
			$rowsBody = [];
			$rowsFoot = [];
			$rows = [];
			$col = $this->getElementsByTagName('tr');
			foreach($col as $row) {
				$name = strtolower($row->parentNode->nodeName);

				$closestTable = $row->parentNode;
				while(!$closestTable instanceof HTMLTableElement) {
					$closestTable = $closestTable->parentNode;
				}
				if($closestTable !== $this) {
					continue;
				}

				switch($name) {
				case 'thead':
					$rowsHead[] = $row;
					break;
				case 'table':
				case 'tbody':
					$rowsBody[] = $row;
					break;
				case 'tfoot':
					$rowsFoot[] = $row;
					break;
				}
			}

			array_push($rows, ...$rowsHead);
			array_push($rows, ...$rowsBody);
			array_push($rows, ...$rowsFoot);

			return NodeListFactory::create(...$rows);
		});
	}

	protected function __prop_get_tBodies():HTMLCollection {
		return HTMLCollectionFactory::create(function() {
			$tbodies = [];
			for($i = 0, $len = $this->childNodes->length; $i < $len; $i++) {
				$child = $this->childNodes->item($i);
				if($child !== null && strtolower($child->nodeName) === 'tbody') {
					$tbodies[] = $child;
				}
			}

			return NodeListFactory::create(...$tbodies);
		});
	}

	/**
	 * Return existing child or create it first if it does not exist.
	 * If the child already exists it is simply returned. If not, it will be created first
	 * and inserted at the correct place before being returned.
	 * @param string $name element name
	 * @return HTMLTableCaptionElement|HTMLTableSectionElement|null
	 */
	private function getCreateChild(
		string $name
	):HTMLTableSectionElement|HTMLTableCaptionElement|null {
		$child = $this->hasChildFirst($name);
		if($child === null) {
			/** @var HTMLTableCaptionElement|HTMLTableSectionElement $child */
			$child = $this->ownerDocument->createElement($name);
			$this->placeChild($name, $child);
		}

		/** @var HTMLTableCaptionElement|HTMLTableSectionElement|null $child */
		return $child;
	}

	/**
	 * Remove the child element from the table.
	 * @param string $name element name
	 */
	private function delChild(string $name):void {
		$node = $this->hasChildFirst($name);
		if($node !== null) {
			$this->removeChild($node);
		}
	}

	/**
	 * Check if the table already has the specified child element.
	 * Returns the first occurrence of the child or null if child was not found.
	 * @param string $name element name
	 * @return null|Node
	 */
	private function hasChildFirst(string $name):?Node {
		for($i = 0, $len = $this->childNodes->length; $i < $len; $i++) {
			$child = $this->childNodes->item($i);
			if($child !== null && strtolower($child->nodeName) === $name) {
				return $child;
			}
		}

		return null;
	}

	/**
	 * Check if the table already has the specified child element.
	 * Returns the last occurrence of the child or null if child was not found.
	 * @param string $name element name
	 * @return null|Node
	 */
	private function hasChildLast(string $name):?Node {
		$lastChild = null;
		for($i = 0, $len = $this->childNodes->length; $i < $len; $i++) {
			$child = $this->childNodes->item($i);
			if($child !== null && strtolower($child->nodeName) === $name) {
				$lastChild = $child;
			}
		}

		return $lastChild;
	}

	/**
	 * Insert the section element after the specified nodes.
	 * @param HTMLTableSectionElement $newNode
	 * @param string[] $refNames names of nodes to insert after
	 */
	private function insertChildAfter(HTMLTableSectionElement $newNode, array $refNames):void {
		$child = $this->firstElementChild;
		while($child && in_array($child->nodeName, $refNames, true)) {
			$child = $child->nextElementSibling;
		}
		$this->insertBefore($newNode, $child);
	}

	/**
	 * Place the child at the correct location.
	 * @param string $name
	 * @param HTMLTableCaptionElement|HTMLTableSectionElement|null $node
	 */
	private function placeChild(string $name, HTMLTableCaptionElement|HTMLTableSectionElement|null $node):void {
		switch($name) {
		case 'caption':
			$this->placeCaption($node);
			break;
		case 'thead':
			$this->placeThead($node);
			break;
		case 'tfoot':
			$this->placeTFoot($node);
			break;
		}
	}

	private function placeCaption(?HTMLTableCaptionElement $caption):void {
		if($caption !== null) {
			$this->insertBefore($caption, $this->firstChild);
		}
	}

	private function placeThead(?HTMLTableSectionElement $thead):void {
		if($thead !== null) {
			$this->insertChildAfter($thead, ['caption', 'colgroup']);
		}
	}

	private function placeTBody(?HTMLTableSectionElement $tbody):void {
		if($tbody !== null) {
			$this->insertChildAfter($tbody, ['caption', 'colgroup', 'thead', 'tbody']);
		}
	}

	private function placeTFoot(?HTMLTableSectionElement $tfoot):void {
		if($tfoot !== null) {
			$this->appendChild($tfoot);
		}
	}
}
