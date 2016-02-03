<?php
namespace phpgt\dom;

class ExampleLivePropertyGetter {
use LivePropertyGetter;

public function __get($name) {
	if($name === "overload") {
		return "from __get overload";
	}

	return $this->__get_live($name);
}

private function prop_example() {
	return "from prop_example";
}

}