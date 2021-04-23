<?php
namespace Gt\Dom\HTMLElement;

use DateTimeInterface;
use Gt\Dom\NodeList;

/**
 * The HTMLInputElement interface provides special properties and methods for
 * manipulating the options, layout, and presentation of <input> elements.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement
 *
 * Properties that apply only to elements of type `checkbox` or `radio`:
 * @property bool $checked Returns / Sets the current state of the element when type is checkbox or radio.
 * @property bool $defaultChecked Returns / Sets the default state of a radio button or checkbox as originally specified in HTML that created this object.
 * @property-read bool $indeterminate Returns whether the checkbox or radio button is in indeterminate state. For checkboxes, the effect is that the appearance of the checkbox is obscured/greyed in some way as to indicate its state is indeterminate (not checked but not unchecked). Does not affect the value of the checked attribute, and clicking the checkbox will set the value to false.
 *
 * Properties that apply only to elements of type `image`:
 * @property string $alt Returns / Sets the element's alt attribute, containing alternative text to use when type is image.
 * @property int $height Returns / Sets the element's height attribute, which defines the height of the image displayed for the button, if the value of type is image.
 * @property string $src Returns / Sets the element's src attribute, which specifies a URI for the location of an image to display on the graphical submit button, if the value of type is image; otherwise it is ignored.
 * @property int $width Returns / Sets the document's width attribute, which defines the width of the image displayed for the button, if the value of type is image.
 *
 * Properties that apply only to elements of type `file`:
 * @property string $accept Returns / Sets the element's accept attribute, containing comma-separated list of file types accepted by the server when type is file.
 * @property FileList $files Returns/accepts a FileList object, which contains a list of File objects representing the files selected for upload.
 *
 * Properties that only apply to elements of type `submit` or `image`:
 * @property string $formAction Is a DOMString reflecting the URI of a resource that processes information submitted by the HTMLUIElement. If specified, this attribute overrides the action attribute of the <form> element that owns this element.
 * @property string $formEncType Is a DOMString reflecting the type of content that is used to submit the form to the server. If specified, this attribute overrides the enctype attribute of the <form> element that owns this element.
 * @property string $formMethod Is a DOMString reflecting the HTTP method that the browser uses to submit the form. If specified, this attribute overrides the method attribute of the <form> element that owns this element.
 * @property bool $formNoValidate Is a Boolean indicating that the form is not to be validated when it is submitted. If specified, this attribute overrides the novalidate attribute of the <form> element that owns this element.
 * @property string $formTarget Is a DOMString reflecting a name or keyword indicating where to display the response that is received after submitting the form. If specified, this attribute overrides the target attribute of the <form> element that owns this element.
 *
 * Properties that apply only to text/number-containing or elements:
 * @property string $max Returns / Sets the element's max attribute, containing the maximum (numeric or date-time) value for this item, which must not be less than its minimum (min attribute) value.
 * @property int $maxLength Returns / Sets the element's maxlength attribute, containing the maximum number of characters (in Unicode code points) that the value can have. (If you set this to a negative number, an exception will be thrown.)
 * @property string $min Returns / Sets the element's min attribute, containing the minimum (numeric or date-time) value for this item, which must not be greater than its maximum (max attribute) value.
 * @property int $minLength Returns / Sets the element's minlength attribute, containing the minimum number of characters (in Unicode code points) that the value can have. (If you set this to a negative number, an exception will be thrown.)
 * @property string $pattern Returns / Sets the element's pattern attribute, containing a regular expression that the control's value is checked against. Use the title attribute to describe the pattern to help the user. This attribute applies when the value of the type attribute is text, search, tel, url or email; otherwise it is ignored.
 * @property string $placeholder Returns / Sets the element's placeholder attribute, containing a hint to the user of what can be entered in the control. The placeholder text must not contain carriage returns or line-feeds. This attribute applies when the value of the type attribute is text, search, tel, url or email; otherwise it is ignored.
 * @property bool $readOnly Returns / Sets the element's readonly attribute, indicating that the user cannot modify the value of the control. This is ignored if the value of the type attribute is hidden, range, color, checkbox, radio, file, or a button type.
 * @property int $selectionStart Returns / Sets the beginning index of the selected text. When nothing is selected, this returns the position of the text input cursor (caret) inside of the <input> element.
 * @property int $selectionEnd Returns / Sets the end index of the selected text. When there's no selection, this returns the offset of the character immediately following the current text input cursor position.
 * @property string $selectionDirection Returns / Sets the direction in which selection occurred.
 * @property int $size Returns / Sets the element's size attribute, containing visual size of the control. This value is in pixels unless the value of type is text or password, in which case, it is an integer number of characters. Applies only when type is set to text, search, tel, url, email, or password; otherwise it is ignored.
 *
 * Properties not yet categorized:
 * @property bool $multiple Returns / Sets the element's multiple attribute, indicating whether more than one value is possible (e.g., multiple files).
 * @property-read NodeList $labels Returns a list of <label> elements that are labels for this element.
 * @property string $step Returns / Sets the element's step attribute, which works with min and max to limit the increments at which a numeric or date-time value can be set. It can be the string any or a positive floating point number. If this is not set to any, the control accepts only values at multiples of the step value greater than the minimum.
 * @property DateTimeInterface $valueAsDate Returns / Sets the value of the element, interpreted as a date, or null if conversion is not possible.
 * @property int|float $valueAsNumber Returns the value of the element, interpreted as one of the following, in order: A time value, A number, NaN if conversion is impossible.
 * @property string $autocapitalize Defines the capitalization behavior for user input. Valid values are none, off, characters, words, or sentences.
 * @property string $inputMode Provides a hint to browsers as to the type of virtual keyboard configuration to use when editing this element or its contents.
 */
class HTMLInputElement extends HTMLElement {
	use HTMLUIElement;

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement#checked */
	protected function __prop_get_checked():bool {
		return $this->hasAttribute("checked");
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement#checked */
	protected function __prop_set_checked(bool $value):void {
		if($value) {
			$this->setAttribute("checked", "");
		}
		else {
			$this->removeAttribute("checked");
		}
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement#defaultChecked */
	protected function __prop_get_defaultChecked():bool {
		return $this->checked;
	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLInputElement#defaultChecked */
	protected function __prop_set_defaultChecked(bool $value):void {
		$this->checked = $value;
	}

	protected function __prop_get_indeterminate():bool {

	}

	protected function __prop_get_alt():string {

	}

	protected function __prop_set_alt(string $value):void {

	}

	protected function __prop_get_height():int {

	}

	protected function __prop_set_height(int $value):void {

	}

	protected function __prop_get_src():string {

	}

	protected function __prop_set_src(string $value):void {

	}

	protected function __prop_get_width():int {

	}

	protected function __prop_set_width(int $value):void {

	}

	protected function __prop_get_accept():string {

	}

	protected function __prop_set_accept(string $value):void {

	}

	protected function __prop_get_files():FileList {

	}

	protected function __prop_set_files(FileList $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-formaction */
	protected function __prop_get_formAction():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/API/HTMLSelectElement/formAction */
	protected function __prop_set_formAction(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-formenctype */
	protected function __prop_get_formEncType():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-formenctype */
	protected function __prop_set_formEncType(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-formmethod */
	protected function __prop_get_formMethod():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-formmethod */
	protected function __prop_set_formMethod(string $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-formnovalidate */
	protected function __prop_get_formNoValidate():bool {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-formnovalidate */
	protected function __prop_set_formNoValidate(bool $value):void {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-formtarget */
	protected function __prop_get_formTarget():string {

	}

	/** @link https://developer.mozilla.org/en-US/docs/Web/HTML/Element/input#attr-formtarget */
	protected function __prop_set_formTarget(string $value):void {

	}

	protected function __prop_get_max():string {

	}

	protected function __prop_set_max(string $value):void {

	}

	protected function __prop_get_maxLength():int {

	}

	protected function __prop_set_maxLength(int $value):void {

	}

	protected function __prop_get_min():string {

	}

	protected function __prop_set_min(string $value):void {

	}

	protected function __prop_get_minLength():int {

	}

	protected function __prop_set_minLength(int $value):void {

	}

	protected function __prop_get_pattern():string {

	}

	protected function __prop_set_pattern(string $value):void {

	}

	protected function __prop_get_placeholder():string {

	}

	protected function __prop_set_placeholder(string $value):void {

	}

	protected function __prop_get_readOnly():bool {

	}

	protected function __prop_set_readOnly(bool $value):void {

	}

	protected function __prop_get_selectionStart():int {

	}

	protected function __prop_set_selectionStart(int $value):void {

	}

	protected function __prop_get_selectionEnd():int {

	}

	protected function __prop_set_selectionEnd(int $value):void {

	}

	protected function __prop_get_selectionDirection():string {

	}

	protected function __prop_set_selectionDirection(string $value):void {

	}

	protected function __prop_get_size():int {

	}

	protected function __prop_set_size(int $value):void {

	}

	protected function __prop_get_multiple():bool {

	}

	protected function __prop_set_multiple(bool $value):void {

	}

	protected function __prop_get_labels():NodeList {

	}

	protected function __prop_get_step():string {

	}

	protected function __prop_set_step(string $value):void {

	}

	protected function __prop_get_valueAsDate():DateTimeInterface {

	}

	protected function __prop_set_valueAsDate(DateTimeInterface $value):void {

	}

	protected function __prop_get_valueAsNumber():int|float {

	}

	protected function __prop_set_valueAsNumber(int|float $value):void {

	}

	protected function __prop_get_autocapitalize():string {

	}

	protected function __prop_set_autocapitalize(string $value):void {

	}

	protected function __prop_get_inputMode():string {

	}

	protected function __prop_set_inputMode(string $value):void {

	}
}
