<?php
namespace Gt\Dom\Facade;

use Gt\Dom\Node;
use Gt\Dom\NodeFilter;
use Gt\Dom\TreeWalker;

class TreeWalkerFactory extends TreeWalker {
	public static function create(
		Node $root,
		int $whatToShow = NodeFilter::SHOW_ALL,
		NodeFilter|callable $filter = null
	):TreeWalker {
		$class = TreeWalker::class;
		return new $class($root, $whatToShow, $filter);
	}
}
