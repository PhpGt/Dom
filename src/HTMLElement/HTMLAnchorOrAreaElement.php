<?php
namespace Gt\Dom\HTMLElement;

use Gt\Dom\DOMTokenList;

/**
 * This is a non-standard trait that contains functions that are identical
 * to HTMLAnchorElement's implementations, to avoid repetition of code.
 *
 * @property string $download Is a DOMString indicating that the linked resource is intended to be downloaded rather than displayed in the browser. The value represent the proposed name of the file. If the name is not a valid filename of the underlying OS, browser will adapt it.
 * @property string $hash Is a USVString representing the fragment identifier, including the leading hash mark ('#'), if any, in the referenced URL.
 * @property string $host Is a USVString representing the hostname and port (if it's not the default port) in the referenced URL.
 * @property string $hostname Is a USVString representing the hostname in the referenced URL.
 * @property string $href Is a USVString that is the result of parsing the href HTML attribute relative to the document, containing a valid URL of a linked resource.
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
 */
trait HTMLAnchorOrAreaElement {
	/**
	 * Returns a USVString containing the whole URL. It is a synonym for
	 * this.href, though it can't be used to modify the value.
	 */
	public function __toString():string {
		return $this->href;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/download */
	protected function __prop_get_download():string {
		return $this->getAttribute("download") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/download */
	protected function __prop_set_download(string $value):void {
		$this->setAttribute("download", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hash */
	protected function __prop_get_hash():string {
		if($hash = parse_url($this->href, PHP_URL_FRAGMENT)) {
			return "#$hash";
		}

		return "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hash */
	protected function __prop_set_hash(string $value):void {
		$hashPos = strpos($this->href, "#");
		if($hashPos !== false) {
			$this->href = substr($this->href, 0, $hashPos);
		}

		$value = ltrim($value, "#");
		$this->href = $this->href .= "#$value";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/host */
	protected function __prop_get_host():string {
		if($host = parse_url($this->href, PHP_URL_HOST)) {
			$port = parse_url($this->href, PHP_URL_PORT);
			if($port) {
				return "$host:$port";
			}

			return $host;
		}

		return "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/host */
	protected function __prop_set_host(string $value):void {
		$newHost = strtok($value, ":");
		$newPort = parse_url($value, PHP_URL_PORT);
		$this->href = $this->buildUrl(
			host: $newHost,
			port: $newPort
		);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hostname */
	protected function __prop_get_hostname():string {
		return parse_url($this->href, PHP_URL_HOST);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/hostname */
	protected function __prop_set_hostname(string $value):void {
		$this->href = $this->buildUrl(
			host: $value
		);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/href */
	protected function __prop_get_href():string {
		return $this->getAttribute("href") ?? "";
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/href */
	protected function __prop_set_href(string $value):void {
		$this->setAttribute("href", $value);
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/origin */
	protected function __prop_get_origin():string {
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

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/password */
	protected function __prop_set_password(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/pathname */
	protected function __prop_get_pathname():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/pathname */
	protected function __prop_set_pathname(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/port */
	protected function __prop_get_port():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/port */
	protected function __prop_set_port(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/protocol */
	protected function __prop_get_protocol():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/protocol */
	protected function __prop_set_protocol(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/referrerPolicy */
	protected function __prop_get_referrerPolicy():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/referrerPolicy */
	protected function __prop_set_referrerPolicy(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/rel */
	protected function __prop_get_rel():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/rel */
	protected function __prop_set_rel(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/relList */
	protected function __prop_get_relList():DOMTokenList {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/search */
	protected function __prop_get_search():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/search */
	protected function __prop_set_search(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/target */
	protected function __prop_get_target():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/target */
	protected function __prop_set_target(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/username */
	protected function __prop_get_username():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLAnchorElement/username */
	protected function __prop_set_username(string $value):void {

	}

	/**
	 * Builds and returns a URL string from the existing href attribute
	 * value with the newly supplied overrides.
	 */
	protected function buildUrl(
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
}
