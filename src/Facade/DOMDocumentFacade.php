<?php
namespace Gt\Dom\Facade;

use DOMAttr;
use DOMCdataSection;
use DOMCharacterData;
use DOMComment;
use DOMDocument;
use DOMDocumentFragment;
use DOMDocumentType;
use DOMElement;
use DOMEntity;
use DOMEntityReference;
use DOMNode;
use DOMNodeList;
use DOMNotation;
use DOMProcessingInstruction;
use DOMText;
use DOMXPath;
use Gt\CssXPath\Translator;
use Gt\Dom\Attr;
use Gt\Dom\CDATASection;
use Gt\Dom\Comment;
use Gt\Dom\Document;
use Gt\Dom\DocumentFragment;
use Gt\Dom\DocumentType;
use Gt\Dom\Element;
use Gt\Dom\Exception\XPathQueryException;
use Gt\Dom\Facade\NodeClass\DOMAttrFacade;
use Gt\Dom\Facade\NodeClass\DOMCdataSectionFacade;
use Gt\Dom\Facade\NodeClass\DOMCharacterDataFacade;
use Gt\Dom\Facade\NodeClass\DOMCommentFacade;
use Gt\Dom\Facade\NodeClass\DOMDocumentFragmentFacade;
use Gt\Dom\Facade\NodeClass\DOMDocumentTypeFacade;
use Gt\Dom\Facade\NodeClass\DOMElementFacade;
use Gt\Dom\Facade\NodeClass\DOMEntityFacade;
use Gt\Dom\Facade\NodeClass\DOMEntityReferenceFacade;
use Gt\Dom\Facade\NodeClass\DOMNodeFacade;
use Gt\Dom\Facade\NodeClass\DOMNotationFacade;
use Gt\Dom\Facade\NodeClass\DOMProcessingInstructionFacade;
use Gt\Dom\Facade\NodeClass\DOMTextFacade;
use Gt\Dom\HTMLDocument;
use Gt\Dom\HTMLElement\HTMLAnchorElement;
use Gt\Dom\HTMLElement\HTMLAreaElement;
use Gt\Dom\HTMLElement\HTMLAudioElement;
use Gt\Dom\HTMLElement\HTMLBaseElement;
use Gt\Dom\HTMLElement\HTMLBRElement;
use Gt\Dom\HTMLElement\HTMLButtonElement;
use Gt\Dom\HTMLElement\HTMLCanvasElement;
use Gt\Dom\HTMLElement\HTMLDataElement;
use Gt\Dom\HTMLElement\HTMLDataListElement;
use Gt\Dom\HTMLElement\HTMLDetailsElement;
use Gt\Dom\HTMLElement\HTMLDialogElement;
use Gt\Dom\HTMLElement\HTMLDivElement;
use Gt\Dom\HTMLElement\HTMLDListElement;
use Gt\Dom\HTMLElement\HTMLEmbedElement;
use Gt\Dom\HTMLElement\HTMLFieldSetElement;
use Gt\Dom\HTMLElement\HTMLFormElement;
use Gt\Dom\HTMLElement\HTMLHeadElement;
use Gt\Dom\HTMLElement\HTMLHeadingElement;
use Gt\Dom\HTMLElement\HTMLHRElement;
use Gt\Dom\HTMLElement\HTMLIFrameElement;
use Gt\Dom\HTMLElement\HTMLImageElement;
use Gt\Dom\HTMLElement\HTMLInputElement;
use Gt\Dom\HTMLElement\HTMLLabelElement;
use Gt\Dom\HTMLElement\HTMLLegendElement;
use Gt\Dom\HTMLElement\HTMLLiElement;
use Gt\Dom\HTMLElement\HTMLLinkElement;
use Gt\Dom\HTMLElement\HTMLMapElement;
use Gt\Dom\HTMLElement\HTMLMenuElement;
use Gt\Dom\HTMLElement\HTMLMetaElement;
use Gt\Dom\HTMLElement\HTMLMeterElement;
use Gt\Dom\HTMLElement\HTMLModElement;
use Gt\Dom\HTMLElement\HTMLObjectElement;
use Gt\Dom\HTMLElement\HTMLOListElement;
use Gt\Dom\HTMLElement\HTMLOptGroupElement;
use Gt\Dom\HTMLElement\HTMLOptionElement;
use Gt\Dom\HTMLElement\HTMLOutputElement;
use Gt\Dom\HTMLElement\HTMLParagraphElement;
use Gt\Dom\HTMLElement\HTMLParamElement;
use Gt\Dom\HTMLElement\HTMLPictureElement;
use Gt\Dom\HTMLElement\HTMLPreElement;
use Gt\Dom\HTMLElement\HTMLProgressElement;
use Gt\Dom\HTMLElement\HTMLQuoteElement;
use Gt\Dom\HTMLElement\HTMLScriptElement;
use Gt\Dom\HTMLElement\HTMLSelectElement;
use Gt\Dom\HTMLElement\HTMLSourceElement;
use Gt\Dom\HTMLElement\HTMLSpanElement;
use Gt\Dom\HTMLElement\HTMLStyleElement;
use Gt\Dom\HTMLElement\HTMLTableCaptionElement;
use Gt\Dom\HTMLElement\HTMLTableCellElement;
use Gt\Dom\HTMLElement\HTMLTableColElement;
use Gt\Dom\HTMLElement\HTMLTableElement;
use Gt\Dom\HTMLElement\HTMLTableRowElement;
use Gt\Dom\HTMLElement\HTMLTableSectionElement;
use Gt\Dom\HTMLElement\HTMLTemplateElement;
use Gt\Dom\HTMLElement\HTMLTextAreaElement;
use Gt\Dom\HTMLElement\HTMLTimeElement;
use Gt\Dom\HTMLElement\HTMLTitleElement;
use Gt\Dom\HTMLElement\HTMLTrackElement;
use Gt\Dom\HTMLElement\HTMLUListElement;
use Gt\Dom\HTMLElement\HTMLUnknownElement;
use Gt\Dom\HTMLElement\HTMLVideoElement;
use Gt\Dom\Node;
use Gt\Dom\HTMLElement\HTMLBodyElement;
use Gt\Dom\ProcessingInstruction;
use Gt\Dom\Text;
use ReflectionClass;
use ReflectionMethod;

class DOMDocumentFacade extends DOMDocument {
	const DEFAULT_CLASS = Element::class;
	const DEFAULT_CLASS_HTML = HTMLUnknownElement::class;

	const NODE_CLASS_LIST = [
		"Gt\Dom\Facade\DOMDocumentFacade" => Document::class,
		"Gt\Dom\Facade\NodeClass\DOMDocumentTypeFacade" => DocumentType::class,
		"Gt\Dom\Facade\NodeClass\DOMTextFacade" => Text::class,
		"Gt\Dom\Facade\NodeClass\DOMAttrFacade" => Attr::class,
		"Gt\Dom\Facade\NodeClass\DOMCdataSectionFacade" => CDATASection::class,
		"Gt\Dom\Facade\NodeClass\DOMCommentFacade" => Comment::class,
		"Gt\Dom\Facade\NodeClass\DOMDocumentFragmentFacade" => DocumentFragment::class,
		"Gt\Dom\Facade\NodeClass\DOMProcessingInstructionFacade" => ProcessingInstruction::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::a" => HTMLAnchorElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::area" => HTMLAreaElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::audio" => HTMLAudioElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::base" => HTMLBaseElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::blockquote" => HTMLQuoteElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::body" => HTMLBodyElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::br" => HTMLBRElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::button" => HTMLButtonElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::canvas" => HTMLCanvasElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::caption" => HTMLTableCaptionElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::col" => HTMLTableColElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::colgroup" => HTMLTableColElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::data" => HTMLDataElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::datalist" => HTMLDataListElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::del" => HTMLModElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::details" => HTMLDetailsElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::dialog" => HTMLDialogElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::div" => HTMLDivElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::dl" => HTMLDListElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::embed" => HTMLEmbedElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::fieldset" => HTMLFieldSetElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::form" => HTMLFormElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::head" => HTMLHeadElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::h1" => HTMLHeadingElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::h2" => HTMLHeadingElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::h3" => HTMLHeadingElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::h4" => HTMLHeadingElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::h5" => HTMLHeadingElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::h6" => HTMLHeadingElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::hr" => HTMLHRElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::html" => Element::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::iframe" => HTMLIFrameElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::img" => HTMLImageElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::input" => HTMLInputElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::ins" => HTMLModElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::label" => HTMLLabelElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::legend" => HTMLLegendElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::li" => HTMLLiElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::link" => HTMLLinkElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::map" => HTMLMapElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::menu" => HTMLMenuElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::meta" => HTMLMetaElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::meter" => HTMLMeterElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::object" => HTMLObjectElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::ol" => HTMLOListElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::optgroup" => HTMLOptGroupElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::option" => HTMLOptionElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::output" => HTMLOutputElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::p" => HTMLParagraphElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::param" => HTMLParamElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::picture" => HTMLPictureElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::pre" => HTMLPreElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::progress" => HTMLProgressElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::q" => HTMLQuoteElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::script" => HTMLScriptElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::select" => HTMLSelectElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::source" => HTMLSourceElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::span" => HTMLSpanElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::style" => HTMLStyleElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::table" => HTMLTableElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::tbody" => HTMLTableSectionElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::td" => HTMLTableCellElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::template" => HTMLTemplateElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::tfoot" => HTMLTableSectionElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::th" => HTMLTableCellElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::thead" => HTMLTableSectionElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::tr" => HTMLTableRowElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::textarea" => HTMLTextAreaElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::time" => HTMLTimeElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::title" => HTMLTitleElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::track" => HTMLTrackElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::ul" => HTMLUListElement::class,
		"Gt\Dom\Facade\NodeClass\DOMElementFacade::video" => HTMLVideoElement::class,
	];

	/** @var DOMNode[] */
	private array $domNodeList = [];
	/** @var Node[] */
	private array $gtNodeList = [];
	private Document $gtDocument;

	/**
	 * @param string $version
	 * @param string $encoding
	 */
	public function __construct(
		Document $gtDocument,
		$version = "",
		$encoding = ""
	) {
		$this->gtDocument = $gtDocument;
		parent::__construct($version, $encoding);
		$this->registerNodeClasses();
	}

	public function getGtDomNode(DOMNode $node):Node {
		do {
			$key = array_search(
				$node,
				$this->domNodeList,
				true
			);
			if(!is_int($key) || !isset($this->gtNodeList[$key])) {
				self::cacheNativeDomNode($node);
			}
		}
		while(!is_int($key));
		return $this->gtNodeList[$key];
	}

	public function getNativeDomNode(Node $node):DOMNode {
		do {
			$key = array_search($node, $this->gtNodeList, true);
			if(!is_int($key) || !isset($this->domNodeList[$key])) {
				self::cacheGtDomNode($node);
			}
		}
		while(!is_int($key));
		return $this->domNodeList[$key];
	}

	public function query(
		string $expression,
		DOMNode $contextNode = null
	):DOMNodeList {
		$domXPath = new DOMXPath($this);
		$result = $domXPath->query($expression, $contextNode);
		if(!$result) {
			throw new XPathQueryException($expression);
		}

		return $result;
	}

	private function cacheNativeDomNode(DOMNode $node):void {
		if($node instanceof DOMDocumentFacade) {
			$object = $node->gtDocument;
		}
		else {
			$key = get_class($node);
			if(!$node instanceof DOMAttrFacade) {
// DOMAttrFacade uses a local name as its "name" attribute - not for identification.
				if($node->localName) {
					$key .= "::" . $node->localName;
				}
			}
			if(isset(self::NODE_CLASS_LIST[$key])) {
				$gtNodeClass = self::NODE_CLASS_LIST[$key];
			}
			else {
				$gtDocument = $this->getGtDomNode($this);
				$gtNodeClass = self::DEFAULT_CLASS;

				if($gtDocument instanceof HTMLDocument) {
					$gtNodeClass = self::DEFAULT_CLASS_HTML;
				}
			}

			$class = new ReflectionClass($gtNodeClass);
			$object = $class->newInstanceWithoutConstructor();
			$constructor = new ReflectionMethod($object, "__construct");
			$constructor->setAccessible(true);
			$constructor->invoke($object, $node);
		}
		array_push($this->domNodeList, $node);
		array_push($this->gtNodeList, $object);
	}

	private function cacheGtDomNode(Node $node):void {
		$class = new ReflectionClass($node);
		$prop = $class->getProperty("domNode");
		$prop->setAccessible(true);
		$domNode = $prop->getValue($node);
		array_push($this->domNodeList, $domNode);
		array_push($this->gtNodeList, $node);
	}

	private function registerNodeClasses():void {
		$classList = [
			DOMDocument::class => DOMDocumentFacade::class,
			DOMAttr::class => DOMAttrFacade::class,
			DOMCdataSection::class => DOMCdataSectionFacade::class,
			DOMCharacterData::class => DOMCharacterDataFacade::class,
			DOMComment::class => DOMCommentFacade::class,
			DOMDocumentFragment::class => DOMDocumentFragmentFacade::class,
			DOMDocumentType::class => DOMDocumentTypeFacade::class,
			DOMElement::class => DOMElementFacade::class,
			DOMEntity::class => DOMEntityFacade::class,
			DOMEntityReference::class => DOMEntityReferenceFacade::class,
			DOMNode::class => DOMNodeFacade::class,
			DOMNotation::class => DOMNotationFacade::class,
			DOMText::class => DOMTextFacade::class,
			DOMProcessingInstruction::class => DOMProcessingInstructionFacade::class,
		];

		foreach($classList as $baseClass => $extendedClass) {
			$this->registerNodeClass(
				$baseClass,
				$extendedClass
			);
		}
	}
}
