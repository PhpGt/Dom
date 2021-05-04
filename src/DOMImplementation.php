<?php
namespace Gt\Dom;

use DOMDocumentType;
use Gt\Dom\Facade\DOMDocumentFacade;
use Gt\Dom\Facade\HTMLDocumentFactory;
use Gt\Dom\Facade\XMLDocumentFactory;

/**
 * The DOMImplementation interface represents an object providing methods which
 * are not dependent on any particular document. Such an object is returned by
 * the Document.implementation property.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMImplementation
 */
class DOMImplementation {
	protected function __construct(private Document $document) {}

	/**
	 * The DOMImplementation.createDocument() method creates and returns an
	 * XMLDocument.
	 *
	 * @param string $namespaceURI Is a DOMString containing the namespace
	 * URI of the document to be created, or null if the document doesn't
	 * belong to one.
	 * @param string $qualifiedNameStr Is a DOMString containing the
	 * qualified name, that is an optional prefix and colon plus the local
	 * root element name, of the document to be created.
	 * @param ?DocumentType $documentType Is the DocumentType of the
	 * document to be created. It defaults to null.
	 * @return XMLDocument
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMImplementation/createDocument
	 */
	public function createDocument(
		string $namespaceURI,
		string $qualifiedNameStr,
		DocumentType $documentType = null
	):XMLDocument {
		/** @var DOMDocumentFacade $nativeDocument */
		$nativeDocument = $this->document->getNativeDomNode($this->document);

		$nativeType = null;
		if($documentType) {
			/** @var DOMDocumentType $nativeType */
			$nativeType = $this->document->getNativeDomNode($documentType);
		}
		/** @var DOMDocumentFacade $nativeNewDocument */
		$nativeNewDocument = $nativeDocument->implementation->createDocument(
			$namespaceURI,
			$qualifiedNameStr,
			$nativeType
		);

		$refXMLDocument = new \ReflectionClass(XMLDocument::class);
		/** @var XMLDocument $document */
		$document = $refXMLDocument->newInstanceWithoutConstructor();
		$refConstructor = new \ReflectionMethod($document, "__construct");
		$refConstructor->setAccessible(true);
		call_user_func($refConstructor->getClosure($document), "");
		$refProperty = new \ReflectionProperty($document, "domNode");
		$refProperty->setAccessible(true);
		$refProperty->setValue($document, $nativeNewDocument);
		return $document;
	}

	/**
	 * The DOMImplementation.createDocumentType() method returns a
	 * DocumentType object which can either be used with
	 * DOMImplementation.createDocument upon document creation or can be put
	 * into the document via methods like Node.insertBefore() or
	 * Node.replaceChild().
	 *
	 * @param string $qualifiedNameStr Is a DOMString containing the
	 * qualified name, like svg:svg.
	 * @param string $publicId Is a DOMString containing the PUBLIC
	 * identifier.
	 * @param string $systemId Is a DOMString containing the SYSTEM
	 * identifiers.
	 * @return DocumentType
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMImplementation/createDocumentType
	 */
	public function createDocumentType(
		string $qualifiedNameStr,
		string $publicId,
		string $systemId
	):DocumentType {
		/** @var DOMDocumentFacade $nativeDocument */
		$nativeDocument = $this->document->getNativeDomNode($this->document);
		$nativeType = $nativeDocument->implementation->createDocumentType(
			$qualifiedNameStr,
			$publicId,
			$systemId
		);
		/** @var DocumentType $gtType */
		/** @noinspection PhpUnnecessaryLocalVariableInspection */
		$gtType = $this->document->getGtDomNode($nativeType);
		return $gtType;
	}

	/**
	 * The DOMImplementation.createHTMLDocument() method creates a new HTML
	 * Document.
	 *
	 * @param string $title A DOMString containing the title to give the
	 * new HTML document.
	 * @return HTMLDocument
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMImplementation/createHTMLDocument
	 */
	public function createHTMLDocument(
		string $title = ""
	):HTMLDocument {
		$document = HTMLDocumentFactory::create(HTMLDocumentFactory::EMPTY_DOCUMENT_STRING);
		$document->title = $title;
		return $document;
	}

	/**
	 * Returns a Boolean indicating if a given feature is supported or not.
	 * This function is unreliable and kept for compatibility purpose alone:
	 * except for SVG-related queries, it always returns true.
	 * Old browsers are very inconsistent in their behavior.
	 *
	 * @param string $feature
	 * @param string $version
	 * @return bool
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMImplementation/hasFeature
	 * @noinspection PhpUnusedParameterInspection
	 */
	public function hasFeature(string $feature, string $version):bool {
		return true;
	}
}
