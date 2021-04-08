<?php
namespace Gt\Dom\Facade;

use Gt\Dom\HTMLCollection;

/**
 * The callback passed to HTMLCollection's constructor must return a NodeList,
 * making the HTMLCollection "live".
 */
class HTMLCollectionFactory extends HTMLCollection {
	public static function create(callable $callback):HTMLCollection {
		return new HTMLCollection($callback);
	}
}
