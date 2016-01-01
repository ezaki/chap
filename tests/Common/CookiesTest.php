<?php

namespace keika299\ConohaAPI\Tests\Common;


use keika299\ConohaAPI\Common\Cookies;
use keika299\ConohaAPI\Conoha;

class CookiesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Conoha
     */
    private $client;

    public function setUp()
    {
        $data = array(
            'username' => 'ConoHa',
            'password' => 'paSSword123456#$%',
            'tenantId' => '487727e3921d44e3bfe7ebb337bf085e',
            'token' => 'sample00d88246078f2bexample788f7'
        );
        $this->client = new Conoha($data);
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetStoredToken()
    {
        $data = array(
            'username' => 'ConoHa',
            'password' => 'paSSword123456#$%',
            'tenantId' => '487727e3921d44e3bfe7ebb337bf085e',
            'token' => 'sample00d88246078f2bexample788f7',
            'cookies' => [
                'isStoreTokenCookie' => true,
                'storeTokenCookieName' => 'CookieName'
            ]
        );

        $client = new Conoha($data);
        $cookie = new Cookies($client);
        $this->assertEquals(null, $cookie->getStoredToken());
    }

    /**
     * @runInSeparateProcess
     */
    public function testGetStoreTokenCookieName()
    {
        $data = array(
            'username' => 'ConoHa',
            'password' => 'paSSword123456#$%',
            'tenantId' => '487727e3921d44e3bfe7ebb337bf085e',
            'token' => 'sample00d88246078f2bexample788f7',
            'cookies' => [
                'isStoreTokenCookie' => true,
                'storeTokenCookieName' => 'CookieName'
            ]
        );

        $client = new Conoha($data);
        $cookie = new Cookies($client);
        $this->assertEquals('CookieName', $cookie->getStoreTokenCookieName());

        $data = array(
            'username' => 'ConoHa',
            'password' => 'paSSword123456#$%',
            'tenantId' => '487727e3921d44e3bfe7ebb337bf085e',
            'token' => 'sample00d88246078f2bexample788f7',
            'cookies' => [
                'isStoreTokenCookie' => true
            ]
        );

        $client = new Conoha($data);
        $cookie = new Cookies($client);
        $this->assertEquals('ConohaAPIToken', $cookie->getStoreTokenCookieName());
    }
}
