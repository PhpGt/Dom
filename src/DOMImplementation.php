<?php
namespace Gt\Dom;

/**
 * The DOMImplementation interface represents an object providing methods which
 * are not dependent on any particular document. Such an object is returned by
 * the Document.implementation property.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/DOMImplementation
 */
class DOMImplementation {
	protected function __construct(private DocumentType $type) {}

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
	 */
	public function hasFeature(string $feature, string $version):bool {
		return true;
	}
}
