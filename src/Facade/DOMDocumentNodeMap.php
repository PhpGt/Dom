<?php
namespace Gt\Dom\Facade;

use DOMNode;
use Gt\Dom\DocumentType;
use Gt\Dom\Node;
use Gt\Dom\HTMLElement\HTMLBodyElement;

class DOMDocumentNodeMap {
	const NODE_CLASS_LIST = [
		"html" => DocumentType::class,
		"body" => HTMLBodyElement::class,
	];

	/** @var DOMNode[] */
	private static array $domNodeList = [];
	/** @var Node[] */
	private static array $gtNodeList = [];

	public static function get(DOMNode $node):Node {
		do {
			$key = array_search($node, self::$domNodeList);
			if(!is_int($key) || !isset(self::$gtNodeList[$key])) {
				self::cache($node);
			}
		}
		while(!is_int($key));
		return self::$gtNodeList[$key];
	}

	private static function cache(DOMNode $node):void {
		/** @phpstan-ignore-next-line */
		$gtNodeClass = self::NODE_CLASS_LIST[$node->localName ?? $node->name];
		$class = new \ReflectionClass($gtNodeClass);
		$object = $class->newInstanceWithoutConstructor();
		$constructor = new \ReflectionMethod($object, "__construct");
		$constructor->setAccessible(true);
		$constructor->invoke($object, $node);
		array_push(self::$domNodeList, $node);
		array_push(self::$gtNodeList, $object);
	}
}
