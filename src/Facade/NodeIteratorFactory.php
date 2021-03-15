<?php
namespace Gt\Dom\Facade;

use Gt\Dom\Node;
use Gt\Dom\NodeFilter;
use Gt\Dom\NodeIterator;

class NodeIteratorFactory extends NodeIterator {
	public static function create(
		Node $root,
		int $whatToShow = NodeFilter::SHOW_ALL,
		NodeFilter|callable $filter = null
	):NodeIterator {
		$class = NodeIterator::class;
		return new $class($root, $whatToShow, $filter);
	}
}
