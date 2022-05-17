<?php
namespace Gt\Dom;

class HTMLCollectionFactory extends HTMLCollection {
	public static function create(callable $callback):HTMLCollection {
		return new HTMLCollection($callback);
	}

	public static function createHTMLOptionsCollection(
		callable $callback
	):HTMLOptionsCollection {
		return new HTMLOptionsCollection($callback);
	}
}
