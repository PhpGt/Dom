<?php
namespace Gt\Dom\Facade;

use Gt\Dom\DOMStringMap;
use Gt\Dom\Element;

class DOMStringMapFactory extends DOMStringMap {
	public static function createDataset(Element $element):DOMStringMap {
		return new DOMStringMap(
			function() use($element) {
				$keyValuePairs = [];

				foreach($element->attributes as $key => $value) {
					if(!str_starts_with($key, "data-")) {
						continue;
					}

					$trimmedKey = substr($key, strlen("data-"));
					$keyValuePairs[$trimmedKey] = $value;
				}

				return $keyValuePairs;
			},
			/** @param array<string,string> $keyValuePairs */
			function(array $keyValuePairs) use($element) {
				foreach($keyValuePairs as $key => $value) {
					$dataKey = "data-$key";
					$current = $element->getAttribute($dataKey);
					if($value === $current) {
						continue;
					}

					$element->setAttribute($dataKey, $value);
				}
			}
		);
	}
}
