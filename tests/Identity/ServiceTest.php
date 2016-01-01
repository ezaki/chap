<?php

namespace keika299\ConohaAPI\Tests\Identity;


use keika299\ConohaAPI\Common\Network\Request;
use keika299\ConohaAPI\Conoha;
use keika299\ConohaAPI\Identity\Service;

class ServiceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var $service Service
     */
    private $service;

    public function setUp()
    {
        $accessData = array(
            'username' => 'ConoHa',
            'password' => 'paSSword123456#$%',
            'tenantId' => '487727e3921d44e3bfe7ebb337bf085e',
            'token' => 'sample00d88246078f2bexample788f7'
        );
        $this->service = (new Conoha($accessData))->identityService();
    }

    public function testGetVersionInfo()
    {
        $object = $this->service->getVersionInfo();
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetVersionDetail()
    {
        $object = $this->service->getVersionDetail();
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetToken()
    {
        $tokenObject = $this->service->getToken();
        $this->assertEquals('checkValue', $tokenObject->checkKey);
    }

    public function testRequestWithUpdatedToken()
    {
        $request = new Request();
        $this->assertInstanceOf('\keika299\ConohaAPI\Common\Network\Response', $this->service->requestWithUpdatedToken($request));
    }
}
