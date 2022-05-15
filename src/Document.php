<?php
namespace Gt\Dom;

use DOMDocument;
use DOMDocumentType;
use DOMElement;
use DOMNode;
use Gt\Dom\Exception\DocumentMustBeExtendedException;
use ReturnTypeWillChange;
use Stringable;

/**
 * @property-read Element $documentElement
 * @property-read DocumentType $doctype
 */
abstract class Document extends DOMDocument implements Stringable {
	const NodeClassLookup = [
		DOMDocument::class => Document::class,
//		DOMAttr::class => DOMAttrFacade::class,
//		DOMCdataSection::class => DOMCdataSectionFacade::class,
//		DOMCharacterData::class => DOMCharacterDataFacade::class,
//		DOMComment::class => DOMCommentFacade::class,
//		DOMDocumentFragment::class => DOMDocumentFragmentFacade::class,
		DOMDocumentType::class => DocumentType::class,
		DOMElement::class => Element::class,
//		DOMEntity::class => DOMEntityFacade::class,
//		DOMEntityReference::class => DOMEntityReferenceFacade::class,
		DOMNode::class => Node::class,
//		DOMNotation::class => DOMNotationFacade::class,
//		DOMText::class => DOMTextFacade::class,
//		DOMProcessingInstruction::class => DOMProcessingInstructionFacade::class,
	];

	public readonly string $characterSet;
	public readonly string $contentType;

	public function __construct() {
		$className = get_class($this);
		if($className === Document::class) {
			throw new DocumentMustBeExtendedException("You are trying to construct a plain Gt\\Dom\\Document - instead, you should use Gt\\Dom\\HTMLDocument or Gt\\Dom\\XMLDocument");
		}
		elseif($className === XMLDocument::class) {
			$this->contentType = "application/xml";
		}
		elseif($className === HTMLDocument::class) {
			$this->contentType = "text/html";
		}
		parent::__construct("1.0", $this->characterSet);
		$this->registerNodeClasses();
		libxml_use_internal_errors(true);
	}

	public function __toString():string {
		if(get_class($this) === HTMLDocument::class) {
			$string = $this->saveHTML();
		}
		else {
			$string = $this->saveXML();
		}

		$string = mb_convert_encoding(
			$string,
			"UTF-8",
			"HTML-ENTITIES"
		);
		return trim($string) . "\n";
	}

	#[ReturnTypeWillChange]
	public function getElementsByTagName(string $qualifiedName):HTMLCollection {
		return HTMLCollectionFactory::create(function() use($qualifiedName) {
			return parent::getElementsByTagName($qualifiedName);
		});
	}

	private function registerNodeClasses():void {
		foreach(self::NodeClassLookup as $nativeClass => $gtClass) {
			$this->registerNodeClass($nativeClass, $gtClass);
		}
	}
}
