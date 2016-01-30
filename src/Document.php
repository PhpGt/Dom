<?php
namespace g105b\Dom;

/**
 * @property string $characterSet
 * @property string $contentType
 * @property-read string $doctype The document type definition (DTD).
 * @property-read Element $documentElement The direct child of the
 *  document. This is normally the HTML element.
 * @property string $documentURI The location of the document or NULL
 *  if undefined.
 * @property string $encoding Encoding of the document, as specified by the
 *  XML declaration. This attribute is not present in the final DOM Level 3
 *  specification, but is the only way of manipulating XML document encoding
 *  in this implementation.
 * @property bool $formatOutput Nicely formats output with indentation
 *  and extra space.
 * @property-read \DOMImplementation $implementation The DOMImplementation
 * object that handles this document.
 * @property book $preserveWhiteSpace Do not remove redundant white space.
 * @property bool $recover Enables recovery mode, i.e. trying to parse
 *  non-well formed documents. This attribute is not part of the DOM
 *  specification and is specific to libxml.
 * @property bool $resolveExternals Set it to TRUE to load external
 *  entities from a doctype declaration. This is useful for including
 *  character entities in your XML document.
 * @property bool $strictErrorChecking Throws DOMException on errors.
 * @property bool $substituteEntities Whether or not to substitute
 *  entities. This attribute is not part of the DOM specification and is
 *  specific to libxml.
 * @property bool $validateOnParse Loads and validates against the DTD.
 * @property-read string $xmlEncoding An attribute specifying, as part of
 *  the XML declaration, the encoding of this document. This is NULL when
 *  unspecified or when it is not known, such as when the Document was
 *  created in memory.
 * @property string $xmlVersion An attribute specifying, as part of the
 *  XML declaration, the version number of this document. If there is no
 *  declaration and if this document supports the "XML" feature, the
 *  value is "1.0".
 * @property-read NodeList $anchors List of all anchors within the document.
 *  Anchors are <a> elements with a `name` attribute.
 * @property-read Element $body The <body> element.
 * @property-read NodeList $forms List of all <form> elements.
 * @property-read Element $head The <head> element.
 * @property-read NodeList $images List of all <img> elements.
 * @property-read NodeList $links List of all links within the document.
 *  Links are <a> elements with an `href` attribute.
 * @property-read NodeList $scripts List of all <script> elements.
 * @property-read NodeList $styleSheets List of all stylesheets within the
 *  document. Stylesheets are <link> elements with attribute `rel=stylesheet`
 * @property string $title The document title.
 */
class Document extends Element {

public function __construct() {

}

/**
 * Adopts a node from an external document. The node and its subtree is
 * removed from the document it's in (if any), and its ownerDocument is
 * changed to the current document. The node can then be inserted into the
 * current document.
 * @param  Node $externalNode The node from another document to be adopted
 * @return Node	The adopted node that can be used in the current document.
 * The new node's parentNode is null, since it has not yet been inserted
 * into the document tree.
 */
public function adoptNode(Node $externalNode): Node {
	// TODO.
}

}#