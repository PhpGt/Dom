<?php
namespace g105b\Dom;

class Element extends \DOMElement {

/**
 * Removes the object from the tree it belongs to.
 * @return void
 */
public function remove() {
	$this->parentNode->removeChild($this);
}

}#