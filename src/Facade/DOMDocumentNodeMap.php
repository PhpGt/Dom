<?php
namespace Gt\Dom\Facade;

use DOMNode;
use Gt\Dom\DocumentType;
use Gt\Dom\Element;
use Gt\Dom\HTMLElement\HTMLAnchorElement;
use Gt\Dom\HTMLElement\HTMLAreaElement;
use Gt\Dom\HTMLElement\HTMLAudioElement;
use Gt\Dom\HTMLElement\HTMLBaseElement;
use Gt\Dom\HTMLElement\HTMLBRElement;
use Gt\Dom\HTMLElement\HTMLButtonElement;
use Gt\Dom\HTMLElement\HTMLCanvasElement;
use Gt\Dom\HTMLElement\HTMLDataElement;
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
use Gt\Dom\HTMLElement\HTMLMediaElement;
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
use Gt\Dom\HTMLElement\HTMLVideoElement;
use Gt\Dom\Node;
use Gt\Dom\HTMLElement\HTMLBodyElement;

class DOMDocumentNodeMap {
	const DEFAULT_CLASS = Element::class;
	const NODE_CLASS_LIST = [
		"DOMDocumentType" => DocumentType::class,
		"DOMElement::a" => HTMLAnchorElement::class,
		"DOMElement::area" => HTMLAreaElement::class,
		"DOMElement::audio" => HTMLAudioElement::class,
		"DOMElement::base" => HTMLBaseElement::class,
		"DOMElement::blockquote" => HTMLQuoteElement::class,
		"DOMElement::body" => HTMLBodyElement::class,
		"DOMElement::br" => HTMLBRElement::class,
		"DOMElement::button" => HTMLButtonElement::class,
		"DOMElement::canvas" => HTMLCanvasElement::class,
		"DOMElement::caption" => HTMLTableCaptionElement::class,
		"DOMElement::col" => HTMLTableColElement::class,
		"DOMElement::colgroup" => HTMLTableColElement::class,
		"DOMElement::data" => HTMLDataElement::class,
		"DOMElement::del" => HTMLModElement::class,
		"DOMElement::details" => HTMLDetailsElement::class,
		"DOMElement::dialog" => HTMLDialogElement::class,
		"DOMElement::div" => HTMLDivElement::class,
		"DOMElement::dl" => HTMLDListElement::class,
		"DOMElement::embed" => HTMLEmbedElement::class,
		"DOMElement::fieldset" => HTMLFieldSetElement::class,
		"DOMElement::form" => HTMLFormElement::class,
		"DOMElement::head" => HTMLHeadElement::class,
		"DOMElement::h1" => HTMLHeadingElement::class,
		"DOMElement::h2" => HTMLHeadingElement::class,
		"DOMElement::h3" => HTMLHeadingElement::class,
		"DOMElement::h4" => HTMLHeadingElement::class,
		"DOMElement::h5" => HTMLHeadingElement::class,
		"DOMElement::h6" => HTMLHeadingElement::class,
		"DOMElement::hr" => HTMLHRElement::class,
		"DOMElement::html" => Element::class,
		"DOMElement::iframe" => HTMLIFrameElement::class,
		"DOMElement::img" => HTMLImageElement::class,
		"DOMElement::input" => HTMLInputElement::class,
		"DOMElement::ins" => HTMLModElement::class,
		"DOMElement::label" => HTMLLabelElement::class,
		"DOMElement::legend" => HTMLLegendElement::class,
		"DOMElement::li" => HTMLLiElement::class,
		"DOMElement::link" => HTMLLinkElement::class,
		"DOMElement::map" => HTMLMapElement::class,
		"DOMElement::menu" => HTMLMenuElement::class,
		"DOMElement::meta" => HTMLMetaElement::class,
		"DOMElement::meter" => HTMLMeterElement::class,
		"DOMElement::object" => HTMLObjectElement::class,
		"DOMElement::ol" => HTMLOListElement::class,
		"DOMElement::optgroup" => HTMLOptGroupElement::class,
		"DOMElement::option" => HTMLOptionElement::class,
		"DOMElement::output" => HTMLOutputElement::class,
		"DOMElement::p" => HTMLParagraphElement::class,
		"DOMElement::param" => HTMLParamElement::class,
		"DOMElement::picture" => HTMLPictureElement::class,
		"DOMElement::pre" => HTMLPreElement::class,
		"DOMElement::progress" => HTMLProgressElement::class,
		"DOMElement::q" => HTMLQuoteElement::class,
		"DOMElement::script" => HTMLScriptElement::class,
		"DOMElement::select" => HTMLSelectElement::class,
		"DOMElement::source" => HTMLSourceElement::class,
		"DOMElement::span" => HTMLSpanElement::class,
		"DOMElement::style" => HTMLStyleElement::class,
		"DOMElement::table" => HTMLTableElement::class,
		"DOMElement::tbody" => HTMLTableSectionElement::class,
		"DOMElement::td" => HTMLTableCellElement::class,
		"DOMElement::template" => HTMLTemplateElement::class,
		"DOMElement::tfoot" => HTMLTableSectionElement::class,
		"DOMElement::th" => HTMLTableCellElement::class,
		"DOMElement::thead" => HTMLTableSectionElement::class,
		"DOMElement::tr" => HTMLTableRowElement::class,
		"DOMElement::textarea" => HTMLTextAreaElement::class,
		"DOMElement::time" => HTMLTimeElement::class,
		"DOMElement::title" => HTMLTitleElement::class,
		"DOMElement::track" => HTMLTrackElement::class,
		"DOMElement::ul" => HTMLUListElement::class,
		"DOMElement::video" => HTMLVideoElement::class,
	];

	/** @var DOMNode[] */
	private static array $domNodeList = [];
	/** @var Node[] */
	private static array $gtNodeList = [];

	public static function getGtDomNode(DOMNode $node):Node {
		do {
			$key = array_search(
				$node,
				self::$domNodeList,
				true
			);
			if(!is_int($key) || !isset(self::$gtNodeList[$key])) {
				self::cacheNativeDomNode($node);
			}
		}
		while(!is_int($key));
		return self::$gtNodeList[$key];
	}

	public static function getNativeDomNode(Node $node):DOMNode {
		$key = array_search($node, self::$gtNodeList);
		return self::$domNodeList[$key];
	}

	private static function cacheNativeDomNode(DOMNode $node):void {
		$key = get_class($node);
		if($node->localName) {
			$key .= "::" . $node->localName;
		}
		if(isset(self::NODE_CLASS_LIST[$key])) {
			$gtNodeClass = self::NODE_CLASS_LIST[$key];
		}
		else {
			$gtNodeClass = self::DEFAULT_CLASS;
		}

		$class = new \ReflectionClass($gtNodeClass);
		$object = $class->newInstanceWithoutConstructor();
		$constructor = new \ReflectionMethod($object, "__construct");
		$constructor->setAccessible(true);
		$constructor->invoke($object, $node);
		array_push(self::$domNodeList, $node);
		array_push(self::$gtNodeList, $object);
	}
}
