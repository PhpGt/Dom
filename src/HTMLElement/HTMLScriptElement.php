<?php
namespace Gt\Dom\HTMLElement;

/**
 * HTML <script> elements expose the HTMLScriptElement interface, which provides
 * special properties and methods for manipulating the behavior and execution of
 * <script> elements (beyond the inherited HTMLElement interface).
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement
 *
 * @property string $type Is a DOMString representing the MIME type of the script. It reflects the type attribute.
 * @property string $src Is a DOMString representing the URL of an external script. It reflects the src attribute.
 * @property string $charset Is a DOMString representing the character encoding of an external script. It reflects the charset attribute.
 * @property bool $async The async and defer attributes are Boolean attributes that control how the script should be executed. The defer and async attributes must not be specified if the src attribute is absent.
 * @property bool $defer The async and defer attributes are Boolean attributes that control how the script should be executed. The defer and async attributes must not be specified if the src attribute is absent.
 * @property string $crossOrigin Is a DOMString reflecting the CORS setting for the script element. For scripts from other origins, this controls if error information will be exposed.
 * @property string $text Is a DOMString that joins and returns the contents of all Text nodes inside the <script> element (ignoring other nodes like comments) in tree order. On setting, it acts the same way as the textContent IDL attribute.
 * @property bool $noModule Is a Boolean that if true, stops the script's execution in browsers that support ES2015 modules — used to run fallback scripts in older browsers that do not support JavaScript modules.
 * @property string $referrerPolicy Is a DOMString that reflects the referrerpolicy HTML attribute indicating which referrer to use when fetching the script, and fetches done by that script.
 */
class HTMLScriptElement extends HTMLElement {
	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/type */
	protected function __prop_get_type():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/type */
	protected function __prop_set_type(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/src */
	protected function __prop_get_src():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/src */
	protected function __prop_set_src(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/charset */
	protected function __prop_get_charset():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/charset */
	protected function __prop_set_charset(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/async */
	protected function __prop_get_async():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/async */
	protected function __prop_set_async(bool $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/defer */
	protected function __prop_get_defer():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/defer */
	protected function __prop_set_defer(bool $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/crossOrigin */
	protected function __prop_get_crossOrigin():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/crossOrigin */
	protected function __prop_set_crossOrigin(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/text */
	protected function __prop_get_text():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/text */
	protected function __prop_set_text(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/noModule */
	protected function __prop_get_noModule():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/noModule */
	protected function __prop_set_noModule(bool $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/referrerPolicy */
	protected function __prop_get_referrerPolicy():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLScriptElement/referrerPolicy */
	protected function __prop_set_referrerPolicy(string $value):void {

	}
}
