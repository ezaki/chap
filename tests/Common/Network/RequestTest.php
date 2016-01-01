<?php

namespace keika299\ConohaAPI\Tests\Common\Network;


use keika299\ConohaAPI\Common\Network\Request;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Request $request
     */
    private $request;

    public function setUp()
    {
        $this->request = new Request();
    }

    public function testExec()
    {
        $this->request->setMethod('GET');
        $this->request->setBaseURI('https://example.com');
        $this->request->setURI('/foo/bar');
        $this->assertInstanceOf('\keika299\ConohaAPI\Common\Network\Request', $this->request->addHeader('foo', 'bar'));
        $this->request->setBody('foobar');
        $this->assertInstanceOf('\keika299\ConohaAPI\Common\Network\Response', $this->request->exec());
    }

    public function testSetMethod()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Common\Network\Request', $this->request->setMethod('GET'));
    }

    public function testBaseURI()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Common\Network\Request', $this->request->setBaseURI('https://example.com'));
    }

    public function testSetURI()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Common\Network\Request', $this->request->setURI('/foo/bar'));
    }

    public function addHeader()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Common\Network\Request', $this->request->addHeader('foo', 'bar'));
    }

    public function testSetAccept()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Common\Network\Request', $this->request->setAccept('foo'));
    }

    public function testSetBody()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Common\Network\Request', $this->request->setBody('foobar'));
    }

    public function testSetJson()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Common\Network\Request', $this->request->setJson(array('foo' => 'bar')));
    }

    public function testSetToken()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Common\Network\Request', $this->request->setToken('sample00d88246078f2bexample788f7'));
    }
}
