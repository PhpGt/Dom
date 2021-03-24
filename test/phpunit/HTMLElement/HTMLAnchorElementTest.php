<?php
namespace Gt\Dom\Test\HTMLElement;

use Gt\Dom\HTMLElement\HTMLAnchorElement;
use Gt\Dom\Test\TestFactory\NodeTestFactory;

class HTMLAnchorElementTest extends HTMLElementTestCase {
	public function testHrefLang():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		self::assertPropertyAttributeCorrelate($sut, "hreflang");
	}

	public function testText():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		self::assertEmpty($sut->text);

		$randomValue = "";
		for($i = 0; $i < 10; $i++) {
			$newRandomValue = uniqid();
			$randomValue .= $newRandomValue;
			$sut->text .= $newRandomValue;
			self::assertEquals($randomValue, $sut->textContent);
			self::assertEquals($sut->textContent, $sut->text);
		}
	}

	public function testType():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		self::assertPropertyAttributeCorrelate($sut, "type");
	}

	public function testToStringEmpty():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		self::assertEmpty((string)$sut);
	}

	public function testToString():void {
		$url = "https://php.gt";

		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		self::assertEquals($url, (string)$sut);
	}

	public function testDownload():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		self::assertPropertyAttributeCorrelate(
			$sut,
			"download"
		);
	}

	public function testHashEmpty():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		self::assertEmpty($sut->hash);
	}

	public function testHashNone():void {
		$url = "https://php.gt";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		self::assertEmpty($sut->hash);
	}

	public function testHash():void {
		$url = "https://php.gt#hash";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		self::assertEquals("#hash", $sut->hash);
	}

	public function testHashSet():void {
		$url = "https://php.gt";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		$sut->hash = "test";
		self::assertEquals("#test", $sut->hash);
		self::assertEquals("https://php.gt#test", $sut->href);
	}

	public function testHashSetWithHash():void {
		$url = "https://php.gt";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		$sut->hash = "#test";
		self::assertEquals("#test", $sut->hash);
		self::assertEquals("https://php.gt#test", $sut->href);
	}

	public function testHashSetExistingHash():void {
		$url = "https://php.gt#something";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		$sut->hash = "#test";
		self::assertEquals("#test", $sut->hash);
		self::assertEquals("https://php.gt#test", $sut->href);
	}

	public function testHost():void {
		$url = "https://php.gt";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		self::assertEquals("php.gt", $sut->host);
	}

	public function testHostPort():void {
		$url = "http://localhost:8080";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		self::assertEquals("localhost:8080", $sut->host);
	}

	public function testHostRelative():void {
		$url = "/this-is-relative";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		self::assertEquals("", $sut->host);
	}

	public function testHostSet():void {
		$url = "https://php.gt/dom";
		$host = "somewhere.else";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		$sut->host = $host;
		self::assertEquals($host, $sut->host);
		self::assertEquals("https://somewhere.else/dom", $sut->href);
	}

	public function testHostSetRetainUser():void {
		$url = "https://g105b@php.gt/dom";
		$host = "somewhere.else";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		$sut->host = $host;
		self::assertEquals($host, $sut->host);
		self::assertEquals("https://g105b@somewhere.else/dom", $sut->href);
	}

	public function testHostSetRetainUserPass():void {
		$url = "https://g105b:cody123@php.gt/dom";
		$host = "somewhere.else";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		$sut->host = $host;
		self::assertEquals($host, $sut->host);
		self::assertEquals("https://g105b:cody123@somewhere.else/dom", $sut->href);
	}

	public function testHostSetRetainPort():void {
		$url = "http://localhost:8080/something";
		$host = "somewhere.else";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		$sut->host = $host;
		self::assertEquals("$host:8080", $sut->host);
		self::assertEquals("http://somewhere.else:8080/something", $sut->href);
	}

	public function testHostSetNewPort():void {
		$url = "http://localhost:8080/something";
		$host = "somewhere.else:8081";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		$sut->host = $host;
		self::assertEquals($host, $sut->host);
		self::assertEquals("http://somewhere.else:8081/something", $sut->href);
	}

	public function testHostSetRetainQuery():void {
		$url = "https://php.gt/dom?search=HTMLElement";
		$host = "somewhere.else";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		$sut->host = $host;
		self::assertEquals($host, $sut->host);
		self::assertEquals("https://somewhere.else/dom?search=HTMLElement", $sut->href);
	}

	public function testHostSetRetainHash():void {
		$url = "https://php.gt/dom#about";
		$host = "somewhere.else";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		$sut->host = $host;
		self::assertEquals($host, $sut->host);
		self::assertEquals("https://somewhere.else/dom#about", $sut->href);
	}

	public function testHostname():void {
		$url = "http://localhost:8080/example";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		self::assertEquals("localhost", $sut->hostname);
	}

	public function testHostnameSet():void {
		$url = "http://localhost:8080/example";
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = $url;
		$sut->hostname = "somewhere.else";
		self::assertEquals("somewhere.else", $sut->hostname);
		self::assertEquals("http://somewhere.else:8080/example", $sut->href);
	}

	public function testOrigin():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "http://localhost:8080/example";
		self::assertEquals("http://localhost:8080", $sut->origin);
		$sut->href = "https://user:pass@example.com/example?key=value#nothing";
		self::assertEquals("https://user:pass@example.com", $sut->origin);
	}

	public function testPasswordNone():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "http://localhost:8080/example";
		self::assertEmpty($sut->password);
	}

	public function testPassword():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "http://g105b:cody123@localhost:8080/example";
		self::assertEquals("cody123", $sut->password);
	}

	public function testPasswordSet():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "http://g105b:cody123@localhost:8080/example";
		$sut->password = "changeme77";
		self::assertEquals("changeme77", $sut->password);
		self::assertEquals("http://g105b:changeme77@localhost:8080/example", $sut->href);
	}

	public function testPathname():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "http://g105b:cody123@localhost:8080/example";
		self::assertEquals("/example", $sut->pathname);
	}

	public function testPathnameSet():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "https://example.com/example?key=value#test";
		$sut->pathname = "/changed";
		self::assertEquals("/changed", $sut->pathname);
		self::assertEquals("https://example.com/changed?key=value#test", $sut->href);
	}

	public function testPortNone():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "https://example.com/example?key=value#test";
		self::assertEmpty($sut->port);
	}

	public function testPort():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "https://example.com:8080/example?key=value#test";
		self::assertEquals(8080, $sut->port);
	}

	public function testPortSet():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "https://example.com:8080/example?key=value#test";
		$sut->port = 1234;
		self::assertEquals(1234, $sut->port);
		self::assertEquals("https://example.com:1234/example?key=value#test", $sut->href);
	}

	public function testProtocolNone():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "/example?key=value#test";
		self::assertEmpty($sut->protocol);
	}

	public function testProtocol():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "https://example.com/example?key=value#test";
		self::assertEquals("https:", $sut->protocol);
	}

	public function testProtocolSet():void {
		/** @var HTMLAnchorElement $sut */
		$sut = NodeTestFactory::createHTMLElement("a");
		$sut->href = "https://example.com/example?key=value#test";
		$sut->protocol = "http";
		self::assertEquals("http:", $sut->protocol);
		self::assertEquals("http://example.com/example?key=value#test", $sut->href);
	}
}
