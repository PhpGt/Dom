<?php
namespace Gt\Dom;

/**
 * The ProcessingInstruction interface represents a processing instruction;
 * that is, a Node which embeds an instruction targeting a specific application
 * but that can be ignored by any other applications which don't recognize the
 * instruction.
 *
 * A processing instruction is different from the XML declaration.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/ProcessingInstruction
 *
 * @property-read string $target A name identifying the application to which the instruction is targeted.
 */
class ProcessingInstruction extends CharacterData {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/ProcessingInstruction/target */
	public function __prop_get_target():string {

	}
}
