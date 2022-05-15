<?php
namespace Gt\Dom\Test;

use DOMDocument;
use Gt\Dom\Document;
use Gt\Dom\DocumentType;
use Gt\Dom\Element;
use Gt\Dom\Exception\DocumentHasMoreThanOneElementChildException;
use Gt\Dom\Exception\DocumentMustBeExtendedException;
use Gt\Dom\Exception\DocumentStreamNotWritableException;
use Gt\Dom\Exception\HTMLDocumentDoesNotSupportCDATASectionException;
use Gt\Dom\Exception\InvalidCharacterException;
use Gt\Dom\Exception\TextNodeCanNotBeRootNodeException;
use Gt\Dom\Exception\WriteOnNonHTMLDocumentException;
use Gt\Dom\Exception\WrongDocumentErrorException;
use Gt\Dom\Exception\XPathQueryException;
use Gt\Dom\HTMLCollection;
use Gt\Dom\HTMLDocument;
use Gt\Dom\HTMLElement\HTMLBodyElement;
use Gt\Dom\HTMLElement\HTMLHeadElement;
use Gt\Dom\Test\TestFactory\DocumentTestFactory;
use Gt\Dom\Test\TestFactory\NodeTestFactory;
use Gt\Dom\XMLDocument;
use Gt\PropFunc\PropertyReadOnlyException;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase {

}
