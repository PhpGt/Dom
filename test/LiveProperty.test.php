<?php
namespace Gt\Dom;

class LivePropertyTest extends \PHPUnit_Framework_TestCase {

/**
 * This assertion shows that because of the LiveProperty trait,
 * the non-existent attribute "children" is in fact callable, because of the
 * prop_children function.
 */
public function testLiveProperty() {
	$document = new HTMLDocument(test\Helper::HTML);
	$this->assertObjectNotHasAttribute("children", $document);
	$this->assertNotEmpty($document->children);
}

/**
 * We can add a magic __get method of our own, which should still be
 * compatible with the trait's.
 */
public function testGetterOnClass() {
	require "ExampleLiveProperty.php";
	$t = new ExampleLiveProperty();
	$this->assertEquals("from __get overload", $t->overload);
	$this->assertEquals("from prop_example", $t->example);
}

}#