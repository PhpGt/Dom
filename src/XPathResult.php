<?php
namespace Gt\Dom;

use DOMNode;
use DOMNodeList;
use Iterator;
use Gt\Dom\Facade\DOMDocumentFacade;

/**
 * The XPathResult interface represents the results generated by evaluating an
 * XPath expression within the context of a given node. Since XPath expressions
 * can result in a variety of result types, this interface makes it possible to
 * determine and handle the type and value of the result.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/XPathResult
 *
 * @implements Iterator<Element|Node>
 */
class XPathResult implements Iterator {
	/** @var DOMNodeList<DOMNode> */
	private DOMNodeList $domNodeList;
	private int $iteratorKey;

	public function __construct(
		string $query,
		DOMDocumentFacade $document,
		DOMNode $context
	) {
		$this->domNodeList = $document->query(
			$query,
			$context
		);
		$this->iteratorKey = 0;
	}

	/**
	 * The iterateNext() method of the XPathResult interface iterates over
	 * a node set result and returns the next node from it or null if there
	 * are no more nodes.
	 *
	 * @return ?Node The next Node within the node set of the XPathResult.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/XPathResult/iterateNext
	 */
	public function iterateNext():?Node {
		$current = $this->current();
		$this->next();
		return $current;
	}

	public function current():Element|Node|null {
		$nativeNode = $this->domNodeList->item($this->iteratorKey);
		if(!$nativeNode) {
			return null;
		}

		/** @var DOMDocumentFacade $document */
		$document = $nativeNode->ownerDocument;
		/** @var Element $element */
		/** @noinspection PhpUnnecessaryLocalVariableInspection */
		$element = $document->getGtDomNode($nativeNode);
		return $element;
	}

	public function next():void {
		$this->iteratorKey++;
	}

	public function key():int {
		return $this->iteratorKey;
	}

	public function valid():bool {
		return $this->domNodeList->length > $this->iteratorKey;
	}

	public function rewind():void {
		$this->iteratorKey = 0;
	}
}