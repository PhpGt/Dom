<?php
namespace Gt\Dom\Facade;

use Gt\Dom\HTMLCollection;

/**
 * The callback passed to HTMLCollection's constructor must return an array of
 * Node objects that represents the list. When the "live" flag is set, the
 * callback will be called every time the list is interacted with, otherwise its
 * first return will be cached.
 */
class HTMLCollectionFactory extends HTMLCollection {
	public static function create(callable $callback):HTMLCollection {
		return new HTMLCollection($callback);
	}
}
