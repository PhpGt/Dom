<?php
namespace g105b\Dom;

class Document extends \DOMDocument {

public function __construct($html) {
	parent::__construct("1.0", "utf-8");
	$this->registerNodeClass("\DOMElement", "\g105b\Dom\Element");
	$this->registerNodeClass("\DOMNode", "\g105b\Dom\Node");

	$this->loadHTML($html);
}

}#