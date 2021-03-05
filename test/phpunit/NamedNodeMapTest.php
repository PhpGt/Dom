<?php
namespace Gt\Dom\Test;

use Gt\Dom\Document;
use Gt\Dom\Element;
use Gt\Dom\Facade\DOMDocumentFacade;
use Gt\Dom\Facade\NamedNodeMapFactory;
use PHPUnit\Framework\TestCase;

class NamedNodeMapTest extends TestCase {
	public function testLength():void {
		$document = new DOMDocumentFacade(new Document());
		$nativeElement = $document->createElement("example");
		$nativeElement->setAttribute("one", "abc");
		$nativeElement->setAttribute("two", "xyz");
		/** @var Element $element */
		$element = $document->getGtDomNode($nativeElement);
		$sut = NamedNodeMapFactory::create(fn() => $nativeElement->attributes, $element);
		self::assertEquals(2, $sut->length);
		self::assertCount(2, $sut);
	}
}
