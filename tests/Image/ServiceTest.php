<?php

namespace keika299\ConohaAPI\Tests\Image;


use keika299\ConohaAPI\Conoha;
use keika299\ConohaAPI\Image\Service;

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
        $this->service = (new Conoha($accessData))->imageService();
    }

    public function testGetVersionInfo()
    {
        $object = $this->service->getVersionInfo();
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetImageList(){
        $object = $this->service->getImageList();
        $this->assertEquals('checkValue', $object->checkKey);

        $object = $this->service->getImageList(array(
            'limit' => 10
        ));
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetImageInfo()
    {
        $object = $this->service->getImageInfo('image UUID');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetImagesSchema()
    {
        $object = $this->service->getImagesSchema();
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetImageSchema()
    {
        $object = $this->service->getImageSchema();
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetMembersSchema()
    {
        $object = $this->service->getMembersSchema();
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetMemberSchema()
    {
        $object = $this->service->getMemberSchema();
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetMemberList()
    {
        $object = $this->service->getMemberList('imageId');
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testDeleteImage()
    {
        $object = $this->service->deleteImage('imageId');
        $this->assertNull($object);
    }

    public function testPutQuota()
    {
        $object = $this->service->putQuota(50);
        $this->assertEquals('checkValue', $object->checkKey);
    }

    public function testGetQuota()
    {
        $object = $this->service->getQuota();
        $this->assertEquals('checkValue', $object->checkKey);
    }
}
