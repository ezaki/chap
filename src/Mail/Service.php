<?php

namespace keika299\ConohaAPI\Mail;

use keika299\ConohaAPI\Common\Network\Request;
use keika299\ConohaAPI\Common\Service\AbstractService;

/**
 * Class Service
 *
 * This class connect to ConoHa mail service.
 *
 * @package keika299\ConohaAPI\Mail
 */
class Service extends AbstractService
{

    /**
     * Get version info.
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
     * Get version detail.
     *
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getVersionDetail()
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1')
            ->setAccept('application/json');

        $response = $request->exec();
        return $response->getJson();
    }

    public function postService($serviceName, $subDomain)
    {
        $data = array(
            'service_name' => $serviceName,
            'default_sub_domain' => $subDomain
        );

        $request = (new Request())
            ->setMethod('POST')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/services')
            ->setAccept('application/json')
            ->setContentType('application/json')
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    public function getServiceList($options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/services')
            ->setAccept('application/json');

        $response = $request->exec();
        return $response->getJson();
    }

    public function getServiceInfo($serviceId)
    {
        return null;
    }

    public function putServiceInfo($serviceId, $serviceName)
    {
        return null;
    }

    public function putBackupState($serviceId, $isBackup)
    {
        return null;
    }

    public function deleteService($serviceId)
    {
        return null;
    }

    public function getQuota($serviceId)
    {
        return null;
    }

    public function putQuota($serviceId, $quota)
    {
        return null;
    }

    public function postDomain($serviceId, $domainName)
    {
        return null;
    }

    public function getDomainList($options = array())
    {
        return null;
    }

    public function deleteDomain($serviceId)
    {
        return null;
    }

    public function getDedicatedIp($domainId)
    {
        return null;
    }

    public function putDedicatedIp($domainId, $isDedicate)
    {
        return null;
    }

    public function postEmail($domainId, $email, $password)
    {
        return null;
    }

    public function getEmailList($options = array())
    {
        return null;
    }

    public function getEmailInfo($emailId)
    {
        return null;
    }

    public function deleteEmail($emailId)
    {
        return null;
    }

    public function putEmailPassword($emailId, $newPassword)
    {
        return null;
    }

    public function putEmailFilterState($emailId, $isFilter, $filterType)
    {
        return null;
    }

    public function putEmailForwardingCopyState($emailId, $isCopy)
    {
        return null;
    }

    public function getMessageList($emailId, $options = array())
    {
        return null;
    }

    public function getMessageAttachment($emailId, $messageId, $attachmentId)
    {
        return null;
    }

    public function deleteMessage($emailId, $messageId)
    {
        return null;
    }

    public function postWebhook($emailId, $webhookURI, $webhookKeyword)
    {
        return null;
    }

    public function getWebhook($emailId)
    {
        return null;
    }

    public function putWebhook($emailId, $webhookURI, $webhookKeyword)
    {
        return null;
    }

    public function deleteWebhook($emailId)
    {
        return null;
    }

    public function getWhiteList($emailId, $options = array())
    {
        return null;
    }

    public function putWhiteList($emailId, $mailList)
    {
        return null;
    }

    public function getBlackList($emailId, $options = array())
    {
        return null;
    }

    public function putBlackList($emailId, $mailList)
    {
        return null;
    }

    public function postForwarding($emailId, $address)
    {
        return null;
    }

    public function getForwardingList($emailId, $options = array())
    {
        return null;
    }

    public function getForwarding($forwardingId)
    {
        return null;
    }

    public function putForwarding($forwardingId, $address)
    {
        return null;
    }

    public function deleteForwarding($forwardingId)
    {
        return null;
    }
}
