<?php
namespace Gt\Dom;

/**
 * The XPathEvaluator interface allows to compile and evaluate XPath
 * expressions. It is implemented by the Document interface.
 *
 * @link https://developer.mozilla.org/en-US/docs/Web/API/XPathEvaluator
 */
trait XPathEvaluator {
	/**
	 * This method compiles an XPathExpression which can then be used for
	 * (repeated) evaluations.
	 *
	 * @param string $xpathText a string which is the XPath expression to
	 * be compiled.
	 * @param ?callable $resolver a function which maps a namespace prefix
	 * to a namespace URL (or null if none needed).
	 * @return XPathExpression
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createExpression
	 */
	public function createExpression(
		string $xpathText,
		callable $resolver = null
	):XPathExpression {

	}

	/**
	 * Creates an XPathNSResolver which resolves namespaces with respect to
	 * the definitions in scope for a specified node.
	 *
	 * @param Node $node the node to be used as a context for namespace resolution.
	 * @return XPathNSResolver an XPathNSResolver object.
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/createNSResolver
	 */
	public function createNSResolver(Node $node):XPathNSResolver {

	}

	/**
	 * The evaluate() method of the XPathEvaluator interface executes an
	 * XPath expression on the given node or document and returns an
	 * XPathResult.
	 *
	 * @param string $xpathExpression a string representing the XPath to be
	 * evaluated.
	 * @param Node $contextNode specifies the context node for the query.
	 * It's common to pass document as the context node.
	 * @param ?XPathNSResolver $resolver a function that will be passed any
	 * namespace prefixes and should return a string representing the
	 * namespace URI associated with that prefix. It will be used to resolve
	 * prefixes within the XPath itself, so that they can be matched with
	 * the document. null is common for HTML documents or when no namespace
	 * prefixes are used.
	 * @param ?int $type an integer that corresponds to the type of result
	 * XPathResult to return. Use named constant properties, such as
	 * XPathResult.ANY_TYPE, of the XPathResult constructor, which
	 * correspond to integers from 0 to 9.
	 * @param ?object $result an existing XPathResult to use for the
	 * results. null is the most common and will create a new XPathResult.
	 * @return XPathResult
	 * @link https://developer.mozilla.org/en-US/docs/Web/API/Document/evaluate
	 */
	public function evaluate(
		string $xpathExpression,
		Node $contextNode,
		XPathNSResolver $resolver = null,
		int $type = null,
		object $result = null
	):XPathResult {

	}
}
