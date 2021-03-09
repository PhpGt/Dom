<?php
namespace Gt\Dom\Test;

use Gt\Dom\Facade\TreeWalkerFactory;
use Gt\Dom\Node;
use Gt\Dom\NodeFilter;
use PHPUnit\Framework\TestCase;

class TreeWalkerTest extends TestCase {
	public function testRoot():void {
		$root = self::createMock(Node::class);
		$sut = TreeWalkerFactory::create($root);
		self::assertSame($root, $sut->root);
	}

	public function testWhatToShow():void {
		$whatToShow = NodeFilter::SHOW_DOCUMENT_FRAGMENT;
		$sut = TreeWalkerFactory::create(
			self::createMock(Node::class),
			$whatToShow
		);
		self::assertSame($whatToShow, $sut->whatToShow);
	}

	public function testFilterFromCallable():void {
		$callCount = 0;
		$callable = function(Node $node) use(&$callCount) {
			$callCount++;
			return $callCount;
		};
		$root = self::createMock(Node::class);
		$sut = TreeWalkerFactory::create(
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
