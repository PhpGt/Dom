<?php
namespace phpgt\dom;

/**
 * @property-read HTMLCollection $children
 */
class HTMLDocument extends Document {

public function __construct($html) {
	parent::__construct();
	$this->loadHTML($html);
}

public function querySelector(string $selectors):Element {
	return $this->documentElement->querySelector($selectors);
}

public function querySelectorAll(string $selectors):HTMLCollection {
	return $this->documentElement->querySelectorAll($selectors);
}

public function __get($name) {
	$dynamicPropertyMethodName = "prop_$name";
	if(method_exists($this, $dynamicPropertyMethodName)) {
		return $this->$dynamicPropertyMethodName();
	}
}

public function prop_children():HTMLCollection {
	return new HTMLCollection($this->childNodes);
}

}#