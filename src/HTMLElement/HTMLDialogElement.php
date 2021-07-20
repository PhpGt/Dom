<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\Exception\FunctionalityNotAvailableOnServerException;

/**
 * The HTMLDialogElement interface provides methods to manipulate <dialog>
 * elements. It inherits properties and methods from the HTMLElement interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDialogElement
 *
 * @property bool $open A Boolean reflecting the open HTML attribute, indicating whether the dialog is available for interaction.
 * @property string $returnValue A DOMString that sets or returns the return value for the dialog.
 */
class HTMLDialogElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDialogElement/open */
	protected function __prop_get_open():bool {
		return $this->hasAttribute("open");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDialogElement/open */
	protected function __prop_set_open(bool $value):void {
		if($value) {
			$this->setAttribute("open","");
		}
		else {
			$this->removeAttribute("open");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDialogElement/returnValue */
	protected function __prop_get_returnValue():string {
		throw new FunctionalityNotAvailableOnServerException("returnValue");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLDialogElement/returnValue */
	protected function __prop_set_returnValue(string $value):void {
		throw new FunctionalityNotAvailableOnServerException("returnValue");
	}
}
