<?php
namespace Gt\Dom;

use Iterator;
use ArrayAccess;
use Gt\Dom\HTMLElement\HTMLOptionElement;

/**
 * @method HTMLOptionElement current()
 * @method HTMLOptionElement|null offsetGet($offset)
 * @implements Iterator<int, HTMLOptionElement>
 * @implements ArrayAccess<int, HTMLOptionElement>
 */
class HTMLOptionsCollection extends HTMLCollection {

}
