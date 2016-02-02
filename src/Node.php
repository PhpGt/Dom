<?php
namespace phpgt\dom;

class Node extends \DOMNode {

public function __construct() {
	parent::__construct();
}

/**
 * Gets the unique hash used to identify the Node within its current Document.
 */
public function getHash() {
	return spl_object_hash($this);
}

}#