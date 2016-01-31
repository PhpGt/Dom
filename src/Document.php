<?php
namespace phpgt\dom;

class Document extends \DOMDocument {

public function __construct($html) {
	parent::__construct("1.0", "utf-8");
	$this->registerNodeClass("\DOMElement", "\phpgt\dom\Element");
	$this->registerNodeClass("\DOMNode", "\phpgt\dom\Node");

	$this->loadHTML($html);
}

}#