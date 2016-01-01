<?php

namespace keika299\ConohaAPI\Tests\Common\Network;


use keika299\ConohaAPI\Common\Network\Response;

class ResponseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Response $response
     */
    private $response;

    protected function setUp()
    {
        $this->response = new Response(new \GuzzleHttp\Psr7\Response(200, ['head' => 'foo'], '{"jsonKey": "jsonValue"}'));
    }

    public function testGetStatusCode()
    {
        $this->assertEquals(200, $this->response->getStatusCode());
    }

    public function testGetBody()
    {
        $this->assertEquals('{"jsonKey": "jsonValue"}', $this->response->getBody());
    }

    public function testGetJson()
    {
        $this->assertEquals(json_decode('{"jsonKey": "jsonValue"}'), $this->response->getJson());
    }
}
