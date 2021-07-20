<?php
namespace Gt\Dom\ClientSide;

use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;

abstract class ClientSideOnly {
	public function __construct() {
		throw new ClientSideOnlyFunctionalityException();
	}
}
