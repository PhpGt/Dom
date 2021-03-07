<?php
namespace Gt\Dom\Facade;

use Gt\Dom\Node;
use Gt\Dom\NodeList;

class NodeListFactory extends NodeList {
	public static function create(Node...$nodeList):NodeList {
		return new NodeList(...$nodeList);
	}

	public static function createLive(callable $callback):NodeList {
		return new NodeList($callback);
	}
}
