<?php

namespace keika299\ConohaAPI\Tests\Common;


use keika299\ConohaAPI\Common\DataStore\Cookies;
use keika299\ConohaAPI\Conoha;

class CookiesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Conoha
     */
    private $client;

    /**
     * @var Cookies
     */
    private $cookie;

    public function setUp()
    {
        $data = array(
            'username' => 'ConoHa',
            'password' => 'paSSword123456#$%',
            'tenantId' => '487727e3921d44e3bfe7ebb337bf085e',
            'token' => 'sample00d88246078f2bexample788f7'
        );
        $this->client = new Conoha($data);
        $this->cookie = new Cookies($this->client);
    }

    /**
     * @runInSeparateProcess
     */
    public function testSaveToken()
    {
        $this->assertNull($this->cookie->saveToken('token value'));
    }

    public function testLoadToken()
    {
        $this->assertNull($this->cookie->loadToken());
    }

    public function testIsStoreTokenCookie()
    {
        $this->assertFalse($this->cookie->isStoreTokenCookie());
    }

    public function testGetStoreTokenCookieName()
    {
        $this->assertEquals('ConohaAPIToken', $this->cookie->getStoreTokenCookieName());
    }
}
