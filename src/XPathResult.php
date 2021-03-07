<?php
namespace Gt\Dom;

use DOMNode;
use DOMNodeList;
use Iterator;
use Gt\Dom\Facade\DOMDocumentFacade;

/** @implements Iterator<Node> */
class XPathResult implements Iterator {
	/** @var DOMNodeList<DOMNode> */
	private DOMNodeList $domNodeList;
	private int $iteratorKey;

	public function __construct(
		private string $query,
		private DOMDocumentFacade $document,
		private DOMNode $context
	) {
		$this->domNodeList = $document->query(
			$query,
			$context
		);
		$this->iteratorKey = 0;
	}

	public function iterateNext():?Node {
		$this->next();
		if($this->valid()) {
			return $this->current();
		}

		return null;
	}

	public function current():?Node {
		$nativeNode = $this->domNodeList->item($this->iteratorKey);
		if(!$nativeNode) {
			return null;
		}

		/** @var DOMDocumentFacade $document */
		$document = $nativeNode->ownerDocument;
		return $document->getGtDomNode($nativeNode);
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
