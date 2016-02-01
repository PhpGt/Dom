<?php
namespace phpgt\dom;

class HTMLDocument extends Document {

public function __construct($html) {
	parent::__construct();
	$this->loadHTML($html);
}

public function querySelector(string $selectors):Element {
	return $this->documentElement->querySelector($selectors);
}

public function querySelectorAll(string $selectors):NodeList {
	return $this->documentElement->querySelectorAll($selectors);
}

}#