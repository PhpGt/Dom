<?php
namespace phpgt\dom;

use DOMNodeList;

/**
 * Wraps the native DOMNodeList in a more usable class, providing iteration
 * and array access
 */
class NodeList {

private $domNodeList;

public function __construct(DomNodeList $domNodeList) {
	$this->domNodeList = $domNodeList;
}

public function __call($name, $args) {
	if(!method_exists($this->domNodeList, $name)) {
		return null;
	}

	$result = call_user_func_array([$this->domNodeList, $name], $args);
	if($result instanceof DomNodeList) {
		return new self($result);
	}

	return $result;
}

public function __get($name) {
	if(!property_exists($this->domNodeList, $name)) {
		return null;
	}

	$result = $this->domNodeList->$name;
	if($result instanceof DomNodeList) {
		return new self($result);
	}

	return $result;
}

}#