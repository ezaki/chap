<?php
/**
 * Created by IntelliJ IDEA.
 * User: gekkeika
 * Date: 2016/01/02
 * Time: 3:50
 */

namespace keika299\ConohaAPI\Tests\DNS;


use keika299\ConohaAPI\Conoha;
use keika299\ConohaAPI\DNS\Service;

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
        $this->service = (new Conoha($accessData))->dnsService();
    }

    public function testGetVersionInfo()
    {
        $object = $this->service->getVersionInfo();
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetDomainHostingInfo()
    {
        $object = $this->service->getDomainHostingInfo('domain uuid');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetDomainList()
    {
        $object = $this->service->getDomainList();
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getDomainList(array(
            'name' => 'domain name'
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPostDomain()
    {
        $object = $this->service->postDomain('domain name', 'mail');
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->postDomain('domain name', 'mail', array(
            'ttl' => 3600,
            'email' => 'mail@example.com',
            'description' => 'this is description',
            'gslb' => true
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testDeleteDomain()
    {
        $object = $this->service->deleteDomain('domain UUID');
        $this->assertNull($object);
    }

    public function testGetDomainInfo()
    {
        $object = $this->service->getDomainInfo('domain UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutDomainInfo()
    {
        $object = $this->service->putDomainInfo('domain UUID');
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->putDomainInfo('domain UUID', array(
            'ttl' => 3360
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetDomainRecords()
    {
        $object = $this->service->getDomainRecords('domain UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPostDomainRecord()
    {
        $object = $this->service->postDomainRecord('domain UUID', 'record name', 'record TYPE', 'record data');
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->postDomainRecord('domain UUID', 'record name', 'record TYPE', 'record data', array(
            'description' => 'this is description'
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testDeleteDomainRecord()
    {
        $object = $this->service->deleteDomainRecord('domain UUID', 'record UUID');
        $this->assertNull($object);
    }

    public function testGetDomainRecord()
    {
        $object = $this->service->getDomainRecord('domain UUID', 'record UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutDomainRecord()
    {
        $object = $this->service->putDomainRecord('domain UUID', 'record UUID');
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->putDomainRecord('domain UUID', 'record UUID', array(
            'name' => 'domain name'
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPostZoneFile()
    {
        $object = $this->service->postZoneFile('zone text');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetZoneFile()
    {
        $object = $this->service->getZoneFile('domain UUID');
        $this->assertNotNull($object);
    }
}
