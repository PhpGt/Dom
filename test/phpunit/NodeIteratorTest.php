<?php
namespace Gt\Dom\Test;

use Gt\Dom\Facade\NodeIteratorFactory;
use Gt\Dom\Node;
use Gt\Dom\NodeFilter;
use Gt\Dom\NodeIterator;
use PHPUnit\Framework\TestCase;

class NodeIteratorTest extends TestCase {
	public function testRoot():void {
		$root = self::createMock(Node::class);
		$sut = NodeIteratorFactory::create($root);
		self::assertSame($root, $sut->root);
	}

	public function testWhatToShowNothing():void {
		$root = self::createMock(Node::class);
		$sut = NodeIteratorFactory::create($root);
		self::assertSame(NodeFilter::SHOW_ALL, $sut->whatToShow);
	}

	public function testWhatToShowBitmask():void {
		$root = self::createMock(Node::class);
		$sut = NodeIteratorFactory::create(
			$root,
			NodeFilter::SHOW_DOCUMENT | NodeFilter::SHOW_DOCUMENT_TYPE
		);
		self::assertGreaterThan(
			0,
			$sut->whatToShow & NodeFilter::SHOW_DOCUMENT
		);
		self::assertGreaterThan(
			0,
			$sut->whatToShow & NodeFilter::SHOW_DOCUMENT_TYPE
		);
		self::assertEquals(
			0,
			$sut->whatToShow & NodeFilter::SHOW_COMMENT
		);
	}

	public function testFilterFromCallable():void {
		$callCount = 0;
		$callable = function(Node $node) use(&$callCount) {
			$callCount++;
			return $callCount;
		};
		$root = self::createMock(Node::class);
		$sut = NodeIteratorFactory::create(
			$root,
			0,
			$callable
		);
		$nodeFilter = $sut->filter;
		$accept = $nodeFilter->acceptNode($root);
		self::assertEquals(1, $callCount);
		self::assertEquals(1, $accept);
	}
}
