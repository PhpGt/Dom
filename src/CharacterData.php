<?php
namespace phpgt\dom;

/**
 * Represents a Node object that contains characters.
 */
class CharacterData extends \DOMCharacterData {
use LivePropertyGetter, NonDocumentTypeChildNode, ChildNode;

}#