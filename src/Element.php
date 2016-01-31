<?php
namespace phpgt\dom;

class Element extends \DOMElement {

/**
 * Removes the object from the tree it belongs to.
 * @return void
 */
public function remove() {
	$this->parentNode->removeChild($this);
}

public function querySelector($selector):Element {
	// TODO.
}

public function querySelectorAll($selector):NodeList {
	// TODO.
}

}#