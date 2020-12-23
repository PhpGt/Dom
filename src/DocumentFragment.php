<?php
namespace Gt\Dom;

use DOMDocument;
use DOMDocumentFragment;
use Exception;

/**
 * Represents a minimal document object that has no parent. It is used as a
 * light-weight version of Document to store well-formed or potentially
 * non-well-formed fragments of XML.
 *
 * Various other methods can take a document fragment as an argument (e.g.,
 * any Node interface methods such as Node.appendChild and Node.insertBefore),
 * in which case the children of the fragment are appended or inserted, not
 * the fragment itself.
 *
 * This interface is also of great use with Web components: <template>
 * elements contains a DocumentFragment in their HTMLTemplateElement::$content
 * property.
 *
 * An empty DocumentFragment can be created using the
 * Document::createDocumentFragment() method or the constructor.
 * @property ?string $innerHTML Gets the HTML serialization of the element's descendants (read only).
 * @property string $innerText Represents the "rendered" text content of a node and its descendants.
 */
class DocumentFragment extends DOMDocumentFragment {
	use LiveProperty, ParentNode;

	public function appendHTML(string $data):bool {
		try {
			$tempDocument = new HTMLDocument($data);

			foreach($tempDocument->body->children as $child) {
				$node = $this->ownerDocument->importNode(
					$child,
					true
				);
				$this->appendChild($node);
			}

			return true;
		}
		catch(Exception $exception) {
			return false;
		}
	}

	protected function getRootDocument(): DOMDocument {
		return $this->ownerDocument;
	}

	public function prop_get_innerText():string {
		return $this->textContent;
	}

	public function prop_set_innerText(string $value):string {
		$this->textContent = $value;
		return $this->textContent;
	}

    public function prop_get_innerHTML():?string {
	    if ($this->hasChildNodes()) {
            $childHtmlArray = [];
            foreach ($this->childNodes as $child) {
                $childHtmlArray [] = $this->ownerDocument->saveHTML($child);
            }

            return implode(PHP_EOL, $childHtmlArray);
        }

        return null;
    }
}
