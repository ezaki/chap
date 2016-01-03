<?php

namespace keika299\ConohaAPI\Common\DataStore;


use keika299\ConohaAPI\Conoha;

/**
 * Class Cookies
 *
 * This class manage cookies.
 *
 * @package keika299\ConohaAPI\Common
 */
class Cookies
{
    /**
     * @var Conoha
     */
    private $client;
    private $cookiesData;

    /**
     * Cookies constructor.
     *
     * @param Conoha $client
     */
    public function __construct(Conoha $client)
    {
        $this->client = $client;
        $this->cookiesData = $client->getCookiesData();
    }

    /**
     * Save token.
     *
     * @param string $token
     * @return null
     */
    public function saveToken($token)
    {
        if ($this->isStoreTokenCookie()) {
            setcookie($this->getStoreTokenCookieName(), $token);
        }
    }

    /**
     * Get stored token.
     *
     * If not set token cookie, this function will return null.
     *
     * @return string|null
     */
    public function loadToken()
    {
        if ($this->isStoreTokenCookie()){
            return filter_input(INPUT_COOKIE, $this->getStoreTokenCookieName());
        }

        return null;
    }

    /**
     * Get allow store token cookie.
     *
     * @return bool
     */
    public function isStoreTokenCookie()
    {
        return (isset($this->cookiesData['isStoreTokenCookie']) && $this->cookiesData['isStoreTokenCookie']);
    }

    /**
     * Get store token cookie name.
     *
     * Default value is 'ConohaAPIToken'.
     *
     * @return string
     */
    public function getStoreTokenCookieName()
    {
        if (isset($this->cookiesData['storeTokenCookieName'])) {
            return $this->cookiesData['storeTokenCookieName'];
        }

        return 'ConohaAPIToken';
    }
}
