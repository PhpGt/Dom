<?php
namespace Gt\Dom\Facade;

use DOMNode;
use Gt\Dom\Node;
use Gt\Dom\HTMLElement\HTMLBodyElement;

class DOMDocumentNodeMap {
	const NODE_CLASS_LIST = [
		"body" => HTMLBodyElement::class
	];

	/** @var DOMNode[] */
	private static array $domNodeList = [];
	/** @var Node[] */
	private static array $gtNodeList = [];

	public static function get(DOMNode $node):Node {
		$key = array_search($node, self::$domNodeList);
		if(!isset(self::$gtNodeList[$key])) {
			self::cache($node);
		}
		return self::$gtNodeList[$key];
	}

	private static function cache(DOMNode $node):void {
		$gtNodeClass = self::NODE_CLASS_LIST[$node->localName];
		$class = new \ReflectionClass($gtNodeClass);
		$object = $class->newInstanceWithoutConstructor();
		$constructor = new \ReflectionMethod($object, "__construct");
		$constructor->setAccessible(true);
		$constructor->invoke($object, $node);
		array_push(self::$domNodeList, $node);
		array_push(self::$gtNodeList, $object);
	}
}
