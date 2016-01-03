<?php

namespace keika299\ConohaAPI\Mail;


use keika299\ConohaAPI\Conoha;

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
        $this->service = (new Conoha($accessData))->mailService();
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

    public function testPostService()
    {
        $object = $this->service->postService('service name', 'default sub domain');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetServiceList()
    {
        $object = $this->service->getServiceList();
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getServiceList(array(
            'offset' => 0,
            'limit' => 1000,
            'sort_key' => 'create_date',
            'sort_type' => 'asc'
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetServiceInfo()
    {
        $object = $this->service->getServiceInfo('service UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutServiceInfo()
    {
        $object = $this->service->putServiceInfo('service UUID', 'service name');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutBackupState()
    {
        $object = $this->service->putBackupState('service UUID', true);
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testDeleteService()
    {
        $object = $this->service->deleteService('service UUID');
        $this->assertNull($object);
    }

    public function testGetQuota()
    {
        $object = $this->service->getQuota('service UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutQuota()
    {
        $object = $this->service->putQuota('service UUID', 5);
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPostDomain()
    {
        $object = $this->service->postDomain('service UUID', 'domain name');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetDomainList()
    {
        $object = $this->service->getDomainList();
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getDomainList(array(
            'service_id' => 'service UUID'
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testDeleteDomain()
    {
        $object = $this->service->deleteDomain('service UUID');
        $this->assertNull($object);
    }

    public function testGetDedicatedIp()
    {
        $object = $this->service->getDedicatedIp('domain UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutDedicatedIp()
    {
        $object = $this->service->putDedicatedIp('domain UUID', true);
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPostEmail()
    {
        $object = $this->service->postEmail('domain UUID', 'email', 'password');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetEmailList()
    {
        $object = $this->service->getEmailList();
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getEmailList(array(
            'domain_id' => 'domain UUID'
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testEmailInfo()
    {
        $object = $this->service->getEmailInfo('email UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testDeleteEmail()
    {
        $object = $this->service->deleteEmail('email UUID');
        $this->assertNull($object);
    }

    public function testPutEmailPassword()
    {
        $object = $this->service->putEmailPassword('email UUID', 'new password');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutEmailFilterState()
    {
        $object = $this->service->putEmailFilterState('email UUID', true, 'tray');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutEmailForwardingCopyState()
    {
        $object = $this->service->putEmailForwardingCopyState('email UUID', true);
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetMessageList()
    {
        $object = $this->service->getMessageList('email UUID');
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getMessageList('email UUID', array(
            'offset' => 0
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetMessage()
    {
        $object = $this->service->getMessage('email UUID', 'message UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetMessageAttachment()
    {
        $object = $this->service->getMessageAttachment('email UUID', 'message UUID', 'attachment UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testDeleteMessage()
    {
        $object = $this->service->deleteMessage('email UUID', 'message UUID');
        $this->assertNull($object);
    }

    public function testPostWebhook()
    {
        $object = $this->service->postWebhook('email UUID', 'webhook uri', 'webhook keyword');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetWebhook()
    {
        $object = $this->service->getWebhook('email UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutWebhook()
    {
        $object = $this->service->putWebhook('email UUID', 'webhook uri', 'webhook keyword');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testDeleteWebhook()
    {
        $object = $this->service->deleteWebhook('email UUID');
        $this->assertNull($object);
    }

    public function testGetWhiteList()
    {
        $object = $this->service->getWhiteList('email UUID');
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getWhiteList('email UUID', array(
            'offset' => 5
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutWhiteList()
    {
        $object = $this->service->putWhiteList('email UUID', array(
            'mail@example.com', 'mail2@example.com'
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetBlackList()
    {
        $object = $this->service->getBlackList('email UUID');
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getBlackList('email UUID', array(
            'offset' => 5
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutBlackList()
    {
        $object = $this->service->putBlackList('email UUID', array(
            'mail@example.com', 'mail2@example.com'
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPostForwarding()
    {
        $object = $this->service->postForwarding('email UUID', 'address');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetForwardingList()
    {
        $object = $this->service->getForwardingList();
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getForwardingList(array(
            'offset' => 5
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetForwarding()
    {
        $object = $this->service->getForwarding('forwarding UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutForwarding()
    {
        $object = $this->service->putForwarding('forwarding UUID', 'address');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testDeleteForwarding()
    {
        $object = $this->service->deleteForwarding('forwarding UUID');
        $this->assertNull($object);
    }
}
