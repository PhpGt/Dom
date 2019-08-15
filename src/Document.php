<?php
namespace Gt\Dom;

use DOMAttr;
use DOMCharacterData;
use DOMComment;
use DOMDocument;
use DOMDocumentFragment;
use DOMDocumentType;
use DOMElement;
use DOMNode;
use DOMText;
use Psr\Http\Message\StreamInterface;
use RuntimeException;
use SplTempFileObject;

/**
 * Represents any web page loaded in the browser and serves as an entry point
 * into the web page's content, the DOM tree (including elements such as
 * <body> or <table>).
 *
 * @property-read DocumentType $doctype;
 * @property-read Element $documentElement
 * @property-read Document $ownerDocument
 *
 * @method Attr createAttribute(string $name)
 * @method Comment createComment(string $data)
 * @method DocumentFragment createDocumentFragment()
 * @method Element createElement(string $name)
 * @method Element createTextNode(string $content)
 * @method ?Element getElementById(string $id)
 */
class Document extends DOMDocument implements StreamInterface {
	use LiveProperty, ParentNode;

	protected $stream;
	protected $streamFilled;

	public function __construct($document = null) {
		libxml_use_internal_errors(true);
		parent::__construct("1.0", "utf-8");
		$this->registerNodeClass(DOMNode::class, Node::class);
		$this->registerNodeClass(DOMElement::class, Element::class);
		$this->registerNodeClass(DOMAttr::class, Attr::class);
		$this->registerNodeClass(DOMDocumentFragment::class, DocumentFragment::class);
		$this->registerNodeClass(DOMDocumentType::class, DocumentType::class);
		$this->registerNodeClass(DOMCharacterData::class, CharacterData::class);
		$this->registerNodeClass(DOMText::class, Text::class);
		$this->registerNodeClass(DOMComment::class, Comment::class);

		if($document instanceof DOMDocument) {
			$node = $this->importNode($document->documentElement, true);
			$this->appendChild($node);

			return;
		}

		$this->stream = fopen("php://memory", "r+");
	}

	protected function getRootDocument():DOMDocument {
		return $this;
	}

	public function __toString() {
		return $this->saveHTML();
	}

	/**
	 * Closes the stream and any underlying resources.
	 *
	 * @return void
	 */
	public function close():void {
		$this->stream = null;
	}

	/**
	 * Separates any underlying resources from the stream.
	 *
	 * After the stream has been detached, the stream is in an unusable state.
	 *
	 * @return resource|null Underlying PHP stream, if any
	 */
	public function detach() {
		$this->fillStream();
		$stream = $this->stream;
		$this->stream = null;
		return $stream;
	}

	/**
	 * Get the size of the stream if known.
	 *
	 * @return int|null Returns the size in bytes if known, or null if unknown.
	 */
	public function getSize() {
		$this->fillStream();
		return $this->getMetadata("unread_bytes");
	}

	/**
	 * Returns the current position of the file read/write pointer
	 *
	 * @return int Position of the file pointer
	 * @throws RuntimeException on error.
	 */
	public function tell() {
		$this->fillStream();
		$tell = ftell($this->stream);

		if($tell === false) {
			throw new RuntimeException("Error getting position of Document Stream");
		}

		return $tell;
	}

	/**
	 * Returns true if the stream is at the end of the stream.
	 *
	 * @return bool
	 */
	public function eof() {
		$this->fillStream();
		return feof($this->stream);
	}

	/**
	 * Returns whether or not the stream is seekable.
	 *
	 * @return bool
	 */
	public function isSeekable() {
		$this->fillStream();
		return $this->getMetadata("seekable");
	}

	/**
	 * Seek to a position in the stream.
	 *
	 * @link http://www.php.net/manual/en/function.fseek.php
	 * @param int $offset Stream offset
	 * @param int $whence Specifies how the cursor position will be calculated
	 *     based on the seek offset. Valid values are identical to the built-in
	 *     PHP $whence values for `fseek()`.  SEEK_SET: Set position equal to
	 *     offset bytes SEEK_CUR: Set position to current location plus offset
	 *     SEEK_END: Set position to end-of-stream plus offset.
	 * @throws RuntimeException on failure.
	 */
	public function seek($offset, $whence = SEEK_SET) {
		$this->fillStream();
		$result = fseek($this->stream, $offset, $whence);

		if($result === false) {
			throw new RuntimeException("Error seeking Document Stream");
		}

		return $result;
	}

	/**
	 * Seek to the beginning of the stream.
	 *
	 * If the stream is not seekable, this method will raise an exception;
	 * otherwise, it will perform a seek(0).
	 *
	 * @throws RuntimeException on failure.
	 * @link http://www.php.net/manual/en/function.fseek.php
	 * @see seek()
	 */
	public function rewind() {
		$this->fillStream();
		return $this->seek(0);
	}

	/**
	 * Returns whether or not the stream is writable.
	 *
	 * @return bool
	 */
	public function isWritable() {
		$this->fillStream();
		return is_writable($this->getMetadata("uri"));
	}

	/**
	 * Write data to the stream.
	 *
	 * @param string $string The string that is to be written.
	 * @return int Returns the number of bytes written to the stream.
	 * @throws RuntimeException on failure.
	 */
	public function write($string) {
		$this->fillStream();
		$bytesWritten = fwrite($this->stream, $string);

		if($bytesWritten === false) {
			throw new RuntimeException("Error writing to Document Stream");
		}

		return $bytesWritten;
	}

	/**
	 * Returns whether or not the stream is readable.
	 *
	 * @return bool
	 */
	public function isReadable() {
		$this->fillStream();
		return is_readable($this->getMetadata("uri"));
	}

	/**
	 * Read data from the stream.
	 *
	 * @param int $length Read up to $length bytes from the object and return
	 *     them. Fewer than $length bytes may be returned if underlying stream
	 *     call returns fewer bytes.
	 * @return string Returns the data read from the stream, or an empty string
	 *     if no bytes are available.
	 * @throws RuntimeException if an error occurs.
	 */
	public function read($length) {
		$this->fillStream();
		$bytesRead = fread($this->stream, $length);

		if($bytesRead === false) {
			throw new RuntimeException("Error reading from Document Stream");
		}

		return $bytesRead;
	}

	/**
	 * Returns the remaining contents in a string
	 *
	 * @return string
	 * @throws RuntimeException if unable to read or an error occurs while
	 *     reading.
	 */
	public function getContents() {
		$this->fillStream();
		$string = stream_get_contents($this->stream);

		if($string === false) {
			throw new RuntimeException("Error getting Document Stream contents");
		}

		return $string;
	}

	/**
	 * Get stream metadata as an associative array or retrieve a specific key.
	 *
	 * The keys returned are identical to the keys returned from PHP's
	 * stream_get_meta_data() function.
	 *
	 * @link http://php.net/manual/en/function.stream-get-meta-data.php
	 * @param string $key Specific metadata to retrieve.
	 * @return array|mixed|null Returns an associative array if no key is
	 *     provided. Returns a specific key value if a key is provided and the
	 *     value is found, or null if the key is not found.
	 */
	public function getMetadata($key = null) {
		$this->fillStream();
		$metaData = stream_get_meta_data($this->stream);

		if(is_null($key)) {
			return $metaData;
		}

		return $metaData[$key] ?? null;
	}

	private function fillStream():void {
		if($this->streamFilled) {
			return;
		}

		fwrite($this->stream, $this->__toString());
		$this->streamFilled = true;
	}
}