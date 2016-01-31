<?php
namespace phpgt\dom;

class HTMLDocument extends Document {

public function __construct($html) {
	parent::__construct();
	$this->loadHTML($html);
}

public function querySelector(string $selectors):Element {
	return new Element("test");
}

}#