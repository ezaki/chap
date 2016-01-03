<?php

namespace keika299\ConohaAPI\DNS;


use keika299\ConohaAPI\Common\Network\Request;
use keika299\ConohaAPI\Common\Service\AbstractService;

/**
 * Class Service
 *
 * This class connect to ConoHa DNS service.
 *
 * @package keika299\ConohaAPI\DNS
 */
class Service extends AbstractService
{
    /**
     * Get version information.
     *
     * See https://www.conoha.jp/docs/paas-dns-get-version-list.html
     *
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getVersionInfo()
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/')
            ->setAccept('application/json');

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get hosting domain information.
     *
     * See https://www.conoha.jp/docs/paas-dns-get-servers-hosting-a-domain.html
     *
     * @param string $domainId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getDomainHostingInfo($domainId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains/'. $domainId .'/servers')
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get hosting domain list.
     *
     * See https://www.conoha.jp/docs/paas-dns-get-servers-hosting-a-domain.html
     *
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getDomainList($options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains')
            ->setQuery($options)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }


    /**
     * Create domain.
     *
     * $name is your domain name.
     * This name require to add period that last.
     * (ex: example.com.)
     *
     * $email is domain owner's email address.
     *
     * $options is ttl, description, and gslb
     * 'ttl' is ttl sec (this is int value).
     * 'description' is description of this domain.
     * 'glsb' is enable or disable GLSB (this is bool).
     *
     *
     * See https://www.conoha.jp/docs/paas-dns-create-domain.html
     *
     * @param $name
     * @param $email
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function postDomain($name, $email, $options = array())
    {
        $optionArray = array_merge(array(
            'name' => $name,
            'email' => $email
        ), $this->createDomainInfoArray($options));

        $request = (new Request())
            ->setMethod('POST')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains')
            ->setAccept('application/json')
            ->setContentType('application/json')
            ->setToken($this->client->getToken())
            ->setJson($optionArray);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Delete domain.
     *
     * $domainId is domain UUID.
     * It can get 'getDomainList' function.
     *
     * See https://www.conoha.jp/docs/paas-dns-delete-a-domain.html
     *
     * @param string $domainId
     * @return null
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function deleteDomain($domainId)
    {
        $request = (new Request())
            ->setMethod('DELETE')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains/' . $domainId)
            ->setToken($this->token->getToken());

        $request->exec();
        return null;
    }

    /**
     * Get domain information.
     *
     * $domainId is domain UUID.
     * It can get 'getDomainList' function.
     *
     * See https://www.conoha.jp/docs/paas-dns-get-a-domain.html
     *
     * @param string $domainId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getDomainInfo($domainId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains/' . $domainId)
            ->setAccept('application/json')
            ->setContentType('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change domain information.
     *
     * $options is ttl, emails, description, and gslb
     * 'ttl' is ttl sec (this is int value).
     * 'email' is domain owner's email address.
     * 'description' is description of this domain.
     * 'glsb' is enable or disable GLSB (this is bool).
     *
     * See https://www.conoha.jp/docs/paas-dns-update-a-domain.html
     *
     * @param string $domainId
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putDomainInfo($domainId, $options = array())
    {
        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains/' . $domainId)
            ->setAccept('application/json')
            ->setToken($this->client->getToken())
            ->setJson($this->createDomainInfoArray($options));

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get domain records.
     *
     * $domainId is domain UUID.
     *
     * See https://www.conoha.jp/docs/paas-dns-list-records-in-a-domain.html
     *
     * @param string $domainId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getDomainRecords($domainId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains/'. $domainId .'/records')
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }


    /**
     * Create new domain record.
     *
     * $domainId is domain UUID.
     * $name is domain record. This is FQDN (ex: www.example.com.)
     * $type is domain record type.
     * You can set [A/AAAA/MX/CNAME/TXT/SRV/NS/PTR].
     * $data is domain record value.
     *
     * $option can set priority, ttl, description, gslb_region, gslb_weight, and gslb_check.
     * 'priority' is require if you create MX or SRV record (This is int value).
     * 'description' is domain description.
     * 'gslb_region' is GSLB's region. You can set [JP/US/SG/AUTO].
     * 'gslb_weight' is GSLB's priority.
     * 'gslb_check' is GSLB's health check port. 0 is off, and other number is to check that port.
     *
     * See https://www.conoha.jp/docs/paas-dns-create-record.html
     *
     * @param string $domainId
     * @param string $name
     * @param string $type
     * @param string $data
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function postDomainRecord($domainId, $name, $type, $data, $options = array())
    {
        $optionArray = array_merge(array(
            'name' => $name,
            'type' => $type,
            'data' => $data
        ), $options);

        $request = (new Request())
            ->setMethod('POST')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains/'. $domainId .'/records')
            ->setAccept('application/json')
            ->setContentType('application/json')
            ->setToken($this->client->getToken())
            ->setJson($optionArray);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Delete domain record.
     *
     * $domainId is domain UUID
     * $recordId is record UUID
     *
     * See https://www.conoha.jp/docs/paas-dns-delete-a-record.html
     *
     * @param string $domainId
     * @param string $recordId
     * @return null
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function deleteDomainRecord($domainId, $recordId)
    {
        $request = (new Request())
            ->setMethod('DELETE')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains/'. $domainId .'/records/'. $recordId)
            ->setToken($this->token->getToken());

        $request->exec();
        return null;
    }

    /**
     * Get domain record information.
     *
     * $domainId is domain UUID
     * $recordId is record UUID
     *
     * See https://www.conoha.jp/docs/paas-dns-get-a-record.html
     *
     * @param $domainId
     * @param $recordId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getDomainRecord($domainId, $recordId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains/'. $domainId .'/records/'. $recordId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change domain record settings.
     *
     * $domainId is domain UUID
     * $recordId is record UUID
     *
     * $options can set name, type, priority, data, ttl, description, gslb_region, gslb_weight, and gslb_check.
     *
     * See https://www.conoha.jp/docs/paas-dns-update-a-record.html
     *
     * @param $domainId
     * @param $recordId
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putDomainRecord($domainId, $recordId, $options = array())
    {
        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains/'. $domainId .'/records/'. $recordId)
            ->setAccept('application/json')
            ->setContentType('application/json')
            ->setToken($this->client->getToken())
            ->setJson($options);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Post zone file.
     *
     * $zoneText is zone file's text data.
     *
     * @param string $zoneText
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function postZoneFile($zoneText)
    {
        $request = (new Request())
            ->setMethod('POST')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/zones')
            ->setContentType('text/dns')
            ->setToken($this->client->getToken())
            ->setBody($zoneText);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get zone file.
     *
     * $domainId is domain UUID.
     *
     * @param string $domainId
     * @return string
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getZoneFile($domainId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/zones/'. $domainId)
            ->setAccept('text/dns')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getBody();
    }

    private function createDomainInfoArray($options)
    {
        if (!isset($options['gslb'])) {
            return $options;
        }

        if ($options['gslb']) {
            $options['gslb'] = 1;
            return $options;
        }

        $options['gslb'] = 0;
        return $options;
    }

}
