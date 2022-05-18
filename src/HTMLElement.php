<?php
namespace Gt\Dom;

use Gt\Dom\ClientSide\CSSStyleDeclaration;
use Gt\Dom\Exception\ClientSideOnlyFunctionalityException;
use Gt\Dom\Exception\IncorrectHTMLElementUsageException;

/**
 * The DOM object model is a strange design, made even stranger by the libxml
 * implementation used by PHP. In order for this library to take advantage of
 * the highly optimised speed of libxml, the classes registered as "node
 * classes" from Document::registerNodeClasses all have to extend the base
 * DOMNode classes, but cannot extend each other. Therefore, even though a
 * DOMElement extends a DOMNode, and a Gt\Dom\Element extends DOMElement and a
 * Gt\Dom\Node extends a DOMNode, it is in fact impossible for a Gt\Dom\Element
 * to extend a Gt\Dom\Node.
 *
 * This is all handled by the underlying implementation, so there is not really
 * any downside, apart from the hierarchy being confusing. What is limited
 * however is the lack of HTMLElement classes that specify the individual
 * functionality of each type of HTML Element - for example, a HTMLSelectElement
 * has a property "options" which contains a list of HTMLOptionElements - this
 * property doesn't make sense to be available to all Elements, so this trait
 * works as a compromise.
 *
 * The intention is to provide IDEs with well-typed autocompletion, but without
 * straying too far from the official specification. This trait contains all
 * functionality introduced by all HTMLElement subtypes, but before each
 * property or method is called, a list of "allowed" Elements is checked,
 * throwing a IncorrectHTMLElementUsageException if incorrectly used.
 *
 * @property string $hreflang Is a DOMString that reflects the hreflang HTML attribute, indicating the language of the linked resource.
 * @property string $text Is a DOMString being a synonym for the Node.textContent property.
 * @property string $type Is a DOMString that reflects the type HTML attribute, indicating the MIME type of the linked resource.
 * @property string $name Is a DOMString representing the name of the object when submitted with a form. If specified, it must not be the empty string.
 * @property bool $checked Returns / Sets the current state of the element when type is checkbox or radio.
 * @property string $href Is a USVString that is the result of parsing the href HTML attribute relative to the document, containing a valid URL of a linked resource.
 * @property string $download Is a DOMString indicating that the linked resource is intended to be downloaded rather than displayed in the browser. The value represent the proposed name of the file. If the name is not a valid filename of the underlying OS, browser will adapt it.
 * @property string $hash Is a USVString representing the fragment identifier, including the leading hash mark ('#'), if any, in the referenced URL.
 * @property string $host Is a USVString representing the hostname and port (if it's not the default port) in the referenced URL.
 * @property string $hostname Is a USVString representing the hostname in the referenced URL.
 * @property-read string $origin Returns a USVString containing the origin of the URL, that is its scheme, its domain and its port.
 * @property string $password Is a USVString containing the password specified before the domain name.
 * @property string $pathname Is a USVString containing an initial '/' followed by the path of the URL, not including the query string or fragment.
 * @property string $port Is a USVString representing the port component, if any, of the referenced URL.
 * @property string $protocol Is a USVString representing the protocol component, including trailing colon (':'), of the referenced URL.
 * @property string $referrerPolicy Is a DOMString that reflects the referrerpolicy HTML attribute indicating which referrer to use.
 * @property string $rel Is a DOMString that reflects the rel HTML attribute, specifying the relationship of the target object to the linked object.
 * @property-read DOMTokenList $relList Returns a DOMTokenList that reflects the rel HTML attribute, as a list of tokens.
 * @property string $search Is a USVString representing the search element, including leading question mark ('?'), if any, of the referenced URL.
 * @property string $target Is a DOMString that reflects the target HTML attribute, indicating where to display the linked resource.
 * @property string $username Is a USVString containing the username specified before the domain name.
 * @property string $alt Is a DOMString that reflects the alt HTML attribute, containing alternative text for the element.
 * @property string $coords Is a DOMString that reflects the coords HTML attribute, containing coordinates to define the hot-spot region.
 * @property string $shape Is a DOMString that reflects the shape HTML attribute, indicating the shape of the hot-spot, limited to known values.
 */
trait HTMLElement {
	private function allowTypes(ElementType...$typeList):void {
		if(!in_array($this->elementType, $typeList)) {
			$debug = debug_backtrace(limit: 2);
			$function = $debug[1]["function"];
			if(str_starts_with($function, "__prop")) {
				$funcProp = "Property";
				$funcPropName = substr($function, strlen("__prop_get_"));
			}
			else {
				$funcProp = "Function";
				$funcPropName = $function;
			}

			/** @var Element $object */
			$object = $debug[1]["object"];
			$actualType = $object->elementType->name;
			throw new IncorrectHTMLElementUsageException("$funcProp '$funcPropName' is not available on '$actualType'");
		}
	}

	public function __toString():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);

		if($this->elementType === ElementType::HTMLAnchorElement
		|| $this->elementType === ElementType::HTMLAreaElement) {
			return $this->href;
		}
		else {
			return "";
		}
	}

	/**
	 * Builds and returns a URL string from the existing href attribute
	 * value with the newly supplied overrides.
	 */
	private function buildUrl(
		string $scheme = null,
		string $user = null,
		string $pass = null,
		string $host = null,
		int $port = null,
		string $path = null,
		string $query = null,
		string $fragment = null,
	):string {
		$existing = parse_url($this->href);
		$new = [
			"scheme" => $scheme,
			"user" => $user,
			"pass" => $pass,
			"host" => $host,
			"port" => $port,
			"path" => $path,
			"query" => $query,
			"fragment" => $fragment,
		];
		// Remove null new parts.
		$new = array_filter($new);
		if(isset($new["query"])) {
			$new["query"] = ltrim($new["query"], "?");
		}
		if(isset($new["fragment"])) {
			$new["fragment"] = ltrim($new["fragment"], "#");
		}

		$url = "";
		if($addScheme = $new["scheme"] ?? $existing["scheme"] ?? null) {
			$url .= "$addScheme://";
		}
		if($addUser = $new["user"] ?? $existing["user"] ?? null) {
			$url .= $addUser;

			if($addPass = $new["pass"] ?? $existing["pass"] ?? null) {
				$url .= ":$addPass";
			}

			$url .= "@";
		}
		if($addHost = $new["host"] ?? $existing["host"] ?? null) {
			$url .= $addHost;
		}
		if($addPort = $new["port"] ?? $existing["port"] ?? null) {
			$url .= ":$addPort";
		}
		if($addPath = $new["path"] ?? $existing["path"] ?? null) {
			$url .= $addPath;
		}
		if($addQuery = $new["query"] ?? $existing["query"] ?? null) {
			$url .= "?$addQuery";
		}
		if($addFrag = $new["fragment"] ?? $existing["fragment"] ?? null) {
			$url .= "#$addFrag";
		}

		return $url;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/style */
	protected function __prop_get_style():CSSStyleDeclaration {
		return new CSSStyleDeclaration();
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLElement/style */
	protected function __prop_set_style(CSSStyleDeclaration $value):void {
		throw new ClientSideOnlyFunctionalityException();
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hreflang */
	protected function __prop_get_hreflang():string {
		$this->allowTypes(ElementType::HTMLAnchorElement);
		return $this->getAttribute("hreflang") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hreflang */
	protected function __prop_set_hreflang(string $value):void {
		$this->allowTypes(ElementType::HTMLAnchorElement);
		$this->setAttribute("hreflang", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/text */
	protected function __prop_get_text():string {
		$this->allowTypes(ElementType::HTMLAnchorElement);
		return $this->textContent;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/text */
	protected function __prop_set_text(string $value):void {
		$this->allowTypes(ElementType::HTMLAnchorElement);
		$this->textContent = $value;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/type */
	protected function __prop_get_type():string {
		$this->allowTypes(ElementType::HTMLAnchorElement, ElementType::HTMLInputElement);
		return $this->getAttribute("type") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/type */
	protected function __prop_set_type(string $value):void {
		$this->allowTypes(ElementType::HTMLAnchorElement, ElementType::HTMLInputElement);
		$this->setAttribute("type", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement/name */
	protected function __prop_get_name():string {
		$this->allowTypes(ElementType::HTMLInputElement);
		return $this->getAttribute("name") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement/name */
	protected function __prop_set_name(string $value):void {
		$this->allowTypes(ElementType::HTMLInputElement);
		$this->setAttribute("name", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement/value */
	protected function __prop_get_value():string {
		$this->allowTypes(ElementType::HTMLInputElement);
		$value = $this->getAttribute("value");
		if(!is_null($value)) {
			return $value;
		}

		if($this->elementType === ElementType::HTMLSelectElement) {
			if($this->selectedIndex === -1) {
				return "";
			}

			return $this->options[$this->selectedIndex]->value;
		}

		return $this->textContent;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement/value */
	protected function __prop_set_value(string $value):void {
		$this->allowTypes(ElementType::HTMLInputElement);
		$this->setAttribute("value", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement#checked */
	protected function __prop_get_checked():bool {
		$this->allowTypes(ElementType::HTMLInputElement);
		return $this->hasAttribute("checked");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement#checked */
	protected function __prop_set_checked(bool $value):void {
		$this->allowTypes(ElementType::HTMLInputElement);
		if($value) {
			$this->setAttribute("checked", "");
		}
		else {
			$this->removeAttribute("checked");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/href */
	protected function __prop_get_href():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		return $this->getAttribute("href") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/href */
	protected function __prop_set_href(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->setAttribute("href", $value);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/download
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/download
	 */
	protected function __prop_get_download():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		return $this->getAttribute("download") ?? "";
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/download
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/download
	 */
	protected function __prop_set_download(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->setAttribute("download", $value);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hash
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/hash
	 */
	protected function __prop_get_hash():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		if($hash = parse_url($this->href, PHP_URL_FRAGMENT)) {
			return "#$hash";
		}

		return "";
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hash
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/hash
	 */
	protected function __prop_set_hash(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->href = $this->buildUrl(
			fragment: $value
		);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/host
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/host
	 */
	protected function __prop_get_host():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		if($host = parse_url($this->href, PHP_URL_HOST)) {
			$port = parse_url($this->href, PHP_URL_PORT);
			if($port) {
				return "$host:$port";
			}

			return $host;
		}

		return "";
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/host
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/host
	 */
	protected function __prop_set_host(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$newHost = strtok($value, ":");
		$newPort = parse_url($value, PHP_URL_PORT);
		$this->href = $this->buildUrl(
			host: $newHost,
			port: $newPort
		);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hostname
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/hostname
	 * @noinspection PhpArrayShapeAttributeCanBeAddedInspection
	 */
	protected function __prop_get_hostname():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		return parse_url($this->href, PHP_URL_HOST);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hostname */
	protected function __prop_set_hostname(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->href = $this->buildUrl(
			host: $value
		);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/origin */
	protected function __prop_get_origin():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$origin = "";
		if($scheme = parse_url($this->href, PHP_URL_SCHEME)) {
			$origin .= "$scheme://";
		}
		if($user = parse_url($this->href, PHP_URL_USER)) {
			$origin .= $user;

			if($pass = parse_url($this->href, PHP_URL_PASS)) {
				$origin .= ":$pass";
			}

			$origin .= "@";
		}
		if($host = parse_url($this->href, PHP_URL_HOST)) {
			$origin .= $host;
		}
		if($port = parse_url($this->href, PHP_URL_PORT)) {
			$origin .= ":$port";
		}

		return $origin;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/password */
	protected function __prop_get_password():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		return parse_url($this->href, PHP_URL_PASS) ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/password */
	protected function __prop_set_password(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->href = $this->buildUrl(
			pass: $value
		);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/pathname
	 * @noinspection PhpArrayShapeAttributeCanBeAddedInspection
	 */
	protected function __prop_get_pathname():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		return parse_url($this->href, PHP_URL_PATH);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/pathname
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/pathname
	 */
	protected function __prop_set_pathname(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->href = $this->buildUrl(
			path: $value
		);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/port
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/port
	 */
	protected function __prop_get_port():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		return parse_url($this->href, PHP_URL_PORT) ?? "";
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/port
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/port
	 */
	protected function __prop_set_port(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->href = $this->buildUrl(
			port: (int)$value
		);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/protocol
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/protocol
	 */
	protected function __prop_get_protocol():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		if($scheme = parse_url($this->href, PHP_URL_SCHEME)) {
			return "$scheme:";
		}

		return "";
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/protocol
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/protocol
	 */
	protected function __prop_set_protocol(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->href = $this->buildUrl(
			scheme: $value
		);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/referrerPolicy
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/referrerPolicy
	 */
	protected function __prop_get_referrerPolicy():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		return $this->getAttribute("referrerpolicy") ?? "";
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/referrerPolicy
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/referrerPolicy
	 */
	protected function __prop_set_referrerPolicy(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->setAttribute("referrerpolicy", $value);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/rel
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/rel
	 */
	protected function __prop_get_rel():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		return $this->getAttribute("rel") ?? "";
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/rel
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/rel
	 */
	protected function __prop_set_rel(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->setAttribute("rel", $value);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/relList
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/relList
	 */
	protected function __prop_get_relList():DOMTokenList {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		return DOMTokenListFactory::create(
			fn() => explode(" ", $this->rel),
			fn(string...$tokens) => $this->rel = implode(" ", $tokens)
		);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/search
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/search
	 */
	protected function __prop_get_search():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		if($query = parse_url($this->href, PHP_URL_QUERY)) {
			return "?$query";
		}

		return "";
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/search
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/search
	 */
	protected function __prop_set_search(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->href = $this->buildUrl(
			query: $value
		);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/target
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/target
	 */
	protected function __prop_get_target():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		return $this->getAttribute("target") ?? "";
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/target
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/target
	 */
	protected function __prop_set_target(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->setAttribute("target", $value);
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/username
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/username
	 */
	protected function __prop_get_username():string {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		return parse_url($this->href, PHP_URL_USER) ?? "";
	}

	/**
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/username
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/username
	 */
	protected function __prop_set_username(string $value):void {
		$this->allowTypes(
			ElementType::HTMLAnchorElement,
			ElementType::HTMLAreaElement,
		);
		$this->href = $this->buildUrl(
			user: $value
		);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/alt */
	protected function __prop_get_alt():string {
		$this->allowTypes(ElementType::HTMLAreaElement);
		return $this->getAttribute("alt") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/alt */
	protected function __prop_set_alt(string $value):void {
		$this->allowTypes(ElementType::HTMLAreaElement);
		$this->setAttribute("alt", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/coords */
	protected function __prop_get_coords():string {
		$this->allowTypes(ElementType::HTMLAreaElement);
		return $this->getAttribute("coords") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/coords */
	protected function __prop_set_coords(string $value):void {
		$this->allowTypes(ElementType::HTMLAreaElement);
		$this->setAttribute("coords", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/shape */
	protected function __prop_get_shape():string {
		return $this->getAttribute("shape") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAreaElement/shape */
	protected function __prop_set_shape(string $value):void {
		$this->setAttribute("shape", $value);
	}
}
