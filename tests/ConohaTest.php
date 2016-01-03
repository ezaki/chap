<?php

namespace keika299\ConohaAPI\Tests;

use keika299\ConohaAPI\Conoha;

class ConohaTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Conoha $client
     */
    private $client;

    protected function setUp()
    {
        $accessData = array(
            'username' => 'ConoHa',
            'password' => 'paSSword123456#$%',
            'tenantId' => '487727e3921d44e3bfe7ebb337bf085e',
            'token' => 'sample00d88246078f2bexample788f7'
        );
        $this->client = new Conoha($accessData);
    }

    public function testSetUpWithoutToken()
    {
        $accessData = array(
            'username' => 'ConoHa',
            'password' => 'paSSword123456#$%',
            'tenantId' => '487727e3921d44e3bfe7ebb337bf085e'
        );
        $client = new Conoha($accessData);
        $this->assertEquals('sample00d88246078f2bexample788f7', $client->getToken());
    }

    public function testGetUsername()
    {
        $this->assertEquals('ConoHa', $this->client->getUsername());
    }

    public function testGetPassword()
    {
        $this->assertEquals('paSSword123456#$%', $this->client->getUserPassword());
    }

    public function testGetTenantID()
    {
        $this->assertEquals('487727e3921d44e3bfe7ebb337bf085e', $this->client->getTenantId());
    }

    public function testGetToken()
    {
        $this->assertEquals('sample00d88246078f2bexample788f7', $this->client->getToken());
    }

    public function testAccountService()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Account\Service', $this->client->accountService());
    }

    public function testBlockStorageService()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\BlockStorage\Service', $this->client->blockStorageService());
    }

    public function testComputeService()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Compute\Service', $this->client->computeService());
    }

    public function testDatabaseService()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Database\Service', $this->client->databaseService());
    }

    public function testDNSService()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\DNS\Service', $this->client->dnsService());
    }

    public function testIdentityService()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Identity\Service', $this->client->identityService());
    }

    public function testImageService()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Image\Service', $this->client->imageService());
    }

    public function testMailService()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Mail\Service', $this->client->mailService());
    }

    public function testNetworkService()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\Network\Service', $this->client->networkService());
    }

    public function testObjectStorageService()
    {
        $this->assertInstanceOf('\keika299\ConohaAPI\ObjectStorage\Service', $this->client->objectStorageService());
    }
}
