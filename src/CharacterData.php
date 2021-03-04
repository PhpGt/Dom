<?php
namespace Gt\Dom;

use Gt\Dom\Facade\NodeClass\DOMCharacterDataFacade;
use Gt\Dom\Facade\NodeClass\DOMTextFacade;

/**
 * The CharacterData abstract interface represents a Node object that contains
 * characters. This is an abstract interface, meaning there aren't any objects
 * of type CharacterData: it is implemented by other interfaces like Text,
 * Comment, or ProcessingInstruction, which aren't abstract.
 *
 * https://developer.mozilla.org/en-US/docs/Web/API/CharacterData
 *
 * @property string $data Is a DOMString representing the textual data contained in this object.
 * @property-read int $length Returns an unsigned long representing the size of the string contained in CharacterData.data.
 */
abstract class CharacterData extends Node {
	use NonDocumentTypeChildNode;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/data */
	protected function __prop_get_data():string {
		return $this->getNativeNode()->data;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/data */
	public function __prop_set_data(string $data):void {
		$this->getNativeNode()->data = $data;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/length */
	public function __prop_get_length():int {
		return $this->getNativeNode()->length;
	}

	/**
	 * Adds the provided data to the end of the Node's current data
	 *
	 * @param string $data The data to append to the given CharacterData.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/appendData
	 */
	public function appendData(string $data):void {
		$this->getNativeNode()->appendData($data);
	}

	/**
	 * Removes the specified amount of characters, starting at the specified
	 * offset, from the CharacterData.data string; when this method returns,
	 * data contains the shortened DOMString.
	 *
	 * @param int $offset an integer representing the number of bytes from
	 * the start of the data to remove from.
	 * @param int $count an integer representing the number of bytes to
	 * remove.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/deleteData
	 */
	public function deleteData(int $offset, int $count):void {
		$this->getNativeNode()->deleteData($offset, $count);
	}

	/**
	 * Inserts the specified characters, at the specified offset, in the
	 * CharacterData.data string; when this method returns, data contains
	 * the modified DOMString.
	 *
	 * @param int $offset The offset number of characters to insert the
	 * provided data at.
	 * @param string $data The data to insert to the given CharacterData.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/insertData
	 */
	public function insertData(int $offset, string $data):void {
		$this->getNativeNode()->insertData($offset, $data);
	}

	/**
	 * Replaces the specified amount of characters, starting at the
	 * specified offset, with the specified DOMString; when this method
	 * returns, data contains the modified DOMString.
	 *
	 * @param int $offset The number of characters from the start of the
	 * data to insert at.
	 * @param int $count The number of characters from the offset to replace
	 * with the provided data.
	 * @param string $data The data to insert into the given CharacterData.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/replaceData
	 */
	public function replaceData(
		int $offset,
		int $count,
		string $data
	):void {
		$this->getNativeNode()->replaceData($offset, $count, $data);
	}

	/**
	 * Returns a DOMString containing the part of CharacterData.data of the
	 * specified length and starting at the specified offset.
	 *
	 * @param int $offset The index of the first character to include in
	 * the returned substring.
	 * @param int $count The number of characters to extract.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/ChildNode/substringData
	 */
	public function substringData(int $offset, int $count):string {
		return $this->getNativeNode()->substringData($offset, $count);
	}

	private function getNativeNode():DOMCharacterDataFacade|DOMTextFacade {
		/** @var DOMCharacterDataFacade $nativeNode */
		$nativeNode = $this->domNode;
		return $nativeNode;
	}
}
