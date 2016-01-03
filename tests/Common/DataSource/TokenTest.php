<?php

namespace keika299\ConohaAPI\Common\DataSource;


use keika299\ConohaAPI\Common\DataStore\Token;
use keika299\ConohaAPI\Conoha;

class TokenTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Conoha
     */
    private $client;

    /**
     * @var Token
     */
    private $token;

    public function setUp()
    {
        $data = array(
            'username' => 'ConoHa',
            'password' => 'paSSword123456#$%',
            'tenantId' => '487727e3921d44e3bfe7ebb337bf085e',
            'token' => 'sample00d88246078f2bexample788f7'
        );
        $this->client = new Conoha($data);
        $this->token = new Token($this->client);
    }

    /**
     * @runInSeparateProcess
     */
    public function testInitToken()
    {
        $this->assertNull($this->token->initToken());

        $data = array(
            'username' => 'ConoHa',
            'password' => 'paSSword123456#$%',
            'tenantId' => '487727e3921d44e3bfe7ebb337bf085e',
            'token' => 'sample00d88246078f2bexample788f7',
            'cookies' => [
                'isStoreTokenCookie' => true,
                'storeTokenCookieName' => 'cookieName'
            ]
        );
        $this->client = new Conoha($data);
        $this->token = new Token($this->client);
    }

    public function testRefreshToken()
    {
        $this->assertNull($this->token->refreshToken());
    }

    public function testGetToken()
    {
        $this->assertEquals('sample00d88246078f2bexample788f7', $this->token->getToken());
    }

    public function testSetToken()
    {
        $this->assertNull($this->token->setToken('new token'));
    }
}
