<?php
namespace Gt\Dom;

use Gt\PropFunc\MagicProp;

class XMLDocument extends Document {
	use MagicProp;

	public function __construct(
		string $xml = "<?xml ?>",
		public readonly string $characterSet = "UTF-8",
	) {
		parent::__construct();
		$this->loadXML($xml);
		if(is_null($this->documentElement)) {
			$this->appendChild($this->createElement("xml"));
		}
	}
}
