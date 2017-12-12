<?php
namespace Gt\Dom\Test;

use Gt\Dom\Test\Helper\Helper;
use Gt\Dom\XMLDocument;
use PHPUnit\Framework\TestCase;

class XMLDocumentTest extends TestCase {
	public function testConstruction() {
		// test construction from raw XML
		$fromRawXML = new XMLDocument(Helper::XML);
		$this->assertInstanceOf(XMLDocument::class, $fromRawXML);
		// test construction from a DOMDocument object
		$domDocument = new \DOMDocument('1.0', 'UTF-8');
		$domDocument->loadXML(Helper::XML);

		$fromDOMDocument = new XMLDocument($domDocument);
		$this->assertInstanceOf(XMLDocument::class, $fromDOMDocument);

		// test construction from a XMLDocument object, just to be sure
		$fromXMLDocument = new XMLDocument($fromRawXML);
		$this->assertInstanceOf(XMLDocument::class, $fromXMLDocument);

	}
}