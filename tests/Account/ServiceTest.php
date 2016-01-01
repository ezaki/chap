<?php

namespace keika299\ConohaAPI\Tests\Account;


use keika299\ConohaAPI\Account\Service;
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
        $this->service = (new Conoha($accessData))->accountService();
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

    public function testGetOrderItems()
    {
        $object = $this->service->getOrderItems();
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetOrderItem()
    {
        $object = $this->service->getOrderItem('itemId');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetProductItems()
    {
        $object = $this->service->getProductItems();
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getProductItems('VPS');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetPaymentHistory()
    {
        $object = $this->service->getPaymentHistory();
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetPaymentSummary()
    {
        $object = $this->service->getPaymentSummary();
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetBillingInvoices()
    {
        $object = $this->service->getBillingInvoices();
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getBillingInvoices(array(
            'offset' => 1,
            'limit' => 1
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetBillingInvoice()
    {
        $object = $this->service->getBillingInvoice('invoiceId');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetNotifications()
    {
        $object = $this->service->getNotifications();
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getNotifications(array(
            'offset' => 1,
            'limit' => 1
        ));
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getNotifications(array(
            'offset' => 1
        ));
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getNotifications(array(
            'limit' => 1
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetNotification()
    {
        $object = $this->service->getNotification('notificationCode');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testPutNotificationStatus()
    {
        $object = $this->service->putNotificationStatus('notificationCode', 'Read');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetObjectStorageRequest()
    {
        $object = $this->service->getObjectStorageRequest();
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getObjectStorageRequest(array(
            'start_date_raw' => 1427161890,
            'end_date_raw' => 1427164620,
            'mode' => 'max'
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetObjectStorageSize()
    {
        $object = $this->service->getObjectStorageSize();
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getObjectStorageSize(array(
            'start_date_raw' => 1427161890,
            'end_date_raw' => 1427164620,
            'mode' => 'max'
        ));
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getObjectStorageSize(array(
            'end_date_raw' => 1427164620,
            'mode' => 'max'
        ));
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getObjectStorageSize(array(
            'mode' => 'max'
        ));
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getObjectStorageSize(array(
            'start_date_raw' => 1427161890,
            'mode' => 'max'
        ));
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getObjectStorageSize(array(
            'start_date_raw' => 1427161890
        ));
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getObjectStorageSize(array(
            'end_date_raw' => 1427164620,
            'mode' => 'max'
        ));
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getObjectStorageSize(array(
            'end_date_raw' => 1427164620
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }
}
