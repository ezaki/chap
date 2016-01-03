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
     * See https://www.conoha.jp/docs/paas-mail-get-version-list.html
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
     * See https://www.conoha.jp/docs/paas-mail-get-version-detail.html
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
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Create mail service.
     *
     * See https://www.conoha.jp/docs/paas-mail-create-mail-service.html
     *
     * @param string $serviceName
     * @param string $subDomain
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
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
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get mail service list.
     *
     * $option can set offset, limit, sort_key, and sort_type.
     * 'offset' is list offset (int value).
     * 'limit' is list limit (int value).
     * 'sort_key is crate_date, service_name, and status.
     * 'sort_type' is asc or desc.
     *
     * See https://www.conoha.jp/docs/paas-mail-list-mail-service.html
     *
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getServiceList($options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/services')
            ->setAccept('application/json')
            ->setQuery($options)
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get mail service information.
     *
     * See https://www.conoha.jp/docs/paas-mail-get-service.html
     *
     * @param string $serviceId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getServiceInfo($serviceId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/services/' . $serviceId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change service informaiton.
     *
     * See https://www.conoha.jp/docs/paas-mail-update-mail-service.html
     *
     * @param string $serviceId
     * @param string $serviceName
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putServiceInfo($serviceId, $serviceName)
    {
        $data = array('service_name' => $serviceName);

        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/services/' . $serviceId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change backup state.
     *
     * See https://www.conoha.jp/docs/paas-mail-create-backup.html
     *
     * @param string $serviceId
     * @param bool $isBackup
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putBackupState($serviceId, $isBackup)
    {
        $isBackupState = $isBackup ? 'enable' : 'disable';

        $data = array(
            'backup' => [
                'status' => $isBackupState
            ]
        );

        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/services/' . $serviceId . '/action')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Delete mail service.
     *
     * See https://www.conoha.jp/docs/paas-mail-delete-mail-service.html
     *
     * @param string $serviceId
     * @return null
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function deleteService($serviceId)
    {
        $request = (new Request())
            ->setMethod('DELETE')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/services/' . $serviceId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $request->exec();

        return null;
    }

    /**
     * Get service quota value.
     *
     * See https://www.conoha.jp/docs/paas-mail-get-email-quotas.html
     *
     * @param string $serviceId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getQuota($serviceId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/services/' . $serviceId . '/quotas')
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change quota value.
     *
     * See https://www.conoha.jp/docs/paas-mail-update-email-quotas.html
     *
     * @param string $serviceId
     * @param int $quota
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putQuota($serviceId, $quota)
    {
        $data = array('quota' => $quota);

        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/services/' . $serviceId . '/quotas')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Create domain information.
     *
     * https://www.conoha.jp/docs/paas-mail-create-domain.html
     *
     * @param string $serviceId
     * @param string $domainName
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function postDomain($serviceId, $domainName)
    {
        $data = array(
            'service_id' => $serviceId,
            'domain_name' => $domainName
        );

        $request = (new Request())
            ->setMethod('POST')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get domains list.
     *
     * $option can set service_id, offset, limit, sort_key, and sort_type.
     * 'service_id' is target service UUID.
     * 'offset' is list offset (int value).
     * 'limit' is list limit (int value).
     * 'sort_key is crate_date, service_name, and status.
     * 'sort_type' is asc or desc.
     *
     * See https://www.conoha.jp/docs/paas-mail-list-domain.html
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
     * Delete domain.
     *
     * See https://www.conoha.jp/docs/paas-mail-delete-domain.html
     *
     * @param string $serviceId
     * @return null
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function deleteDomain($serviceId)
    {$request = (new Request())
        ->setMethod('DELETE')
        ->setBaseURI($this->baseURI)
        ->setURI('/v1/domains/' . $serviceId)
        ->setAccept('application/json')
        ->setToken($this->token->getToken());

        $request->exec();

        return null;
    }

    /**
     * Get domain's dedicated ip.
     *
     * See https://www.conoha.jp/docs/paas-mail-get-dedicated-ip.html
     *
     * @param string $domainId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getDedicatedIp($domainId)
    {
        $request = (new Request())
        ->setMethod('GET')
        ->setBaseURI($this->baseURI)
        ->setURI('/v1/domains/' . $domainId . '/dedicatedip')
        ->setAccept('application/json')
        ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change domain's dedicated ip.
     *
     * See https://www.conoha.jp/docs/paas-mail-create-dedicated-ip.html
     *
     * @param string $domainId
     * @param bool $isDedicate
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putDedicatedIp($domainId, $isDedicate)
    {
        $isDedicateState = $isDedicate ? 'enable' : 'disable';

        $data = array(
            'dedicatedip' => [
                'status' => $isDedicateState
            ]
        );

        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/domains/' . $domainId . '/action')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Create email address.
     *
     * See https://www.conoha.jp/docs/paas-mail-create-email.html
     *
     * @param string $domainId
     * @param string $email
     * @param string $password
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function postEmail($domainId, $email, $password)
    {
        $data = array(
            'domain_id' => $domainId,
            'email' => $email,
            'password' => $password
        );

        $request = (new Request())
            ->setMethod('POST')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get email list.
     *
     * $option can set domain_id, offset, limit, sort_key, and sort_type.
     * 'domain_id' is target domain UUID.
     * 'offset' is list offset (int value).
     * 'limit' is list limit (int value).
     * 'sort_key is crate_date, service_name, and status.
     * 'sort_type' is asc or desc.
     *
     * See https://www.conoha.jp/docs/paas-mail-list-email-domains.html
     *
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getEmailList($options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails')
            ->setQuery($options)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get email info.
     *
     * See https://www.conoha.jp/docs/paas-mail-get-email.html
     *
     * @param string $emailId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getEmailInfo($emailId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Delete email.
     *
     * See https://www.conoha.jp/docs/paas-mail-delete-email.html
     *
     * @param string $emailId
     * @return null
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function deleteEmail($emailId)
    {
        $request = (new Request())
            ->setMethod('DELETE')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $request->exec();
        return null;
    }

    /**
     * Change email password.
     *
     * See https://www.conoha.jp/docs/paas-mail-update-email-password.html
     *
     * @param string $emailId
     * @param string $newPassword
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putEmailPassword($emailId, $newPassword)
    {
        $data = array('password' => $newPassword);
        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/password')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change email filter states.
     *
     * $filterType can select tray or subject.
     *
     * See https://www.conoha.jp/docs/paas-mail-create-email-spam-filter.html
     *
     * @param string $emailId
     * @param bool $isFilter
     * @param string $filterType
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putEmailFilterState($emailId, $isFilter, $filterType)
    {
        $isFilterStatus = $isFilter ? 'enable' : 'disable';

        $data = array(
            'spam' => [
                'status' => $isFilterStatus,
                'type' => $filterType
            ]
        );

        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/action')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change email forwarding copy state.
     *
     * See https://www.conoha.jp/docs/paas-mail-create-email-forwarding-copy.html
     *
     * @param string $emailId
     * @param bool $isCopy
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putEmailForwardingCopyState($emailId, $isCopy)
    {
        $isCopyStatus = $isCopy ? 'enable' : 'disable';

        $data = array(
            'forwarding_copy' => [
                'status' => $isCopyStatus
            ]
        );

        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/action')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get messages list.
     *
     * $option can set offset, limit, sort_key, and sort_type.
     * 'offset' is list offset (int value).
     * 'limit' is list limit (int value).
     * 'sort_key is crate_date, service_name, and status.
     * 'sort_type' is asc or desc.
     *
     * See https://www.conoha.jp/docs/paas-mail-list-messages.html
     *
     * @param string $emailId
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getMessageList($emailId, $options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/messages')
            ->setQuery($options)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get message information.
     *
     * See https://www.conoha.jp/docs/paas-mail-get-messages.html
     *
     * @param string $emailId
     * @param string $messageId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getMessage($emailId, $messageId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/messages/' . $messageId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get message's attachment.
     *
     * This return value contain binary data.
     *
     * See https://www.conoha.jp/docs/paas-mail-get-messages-attachments.html
     *
     * @param string $emailId
     * @param string $messageId
     * @param string $attachmentId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getMessageAttachment($emailId, $messageId, $attachmentId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/messages/' . $messageId . '/attachments/' . $attachmentId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }


    /**
     * Delete message.
     *
     * See https://www.conoha.jp/docs/paas-mail-delete-messages.html
     *
     * @param string $emailId
     * @param string $messageId
     * @return null
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function deleteMessage($emailId, $messageId)
    {
        $request = (new Request())
            ->setMethod('DELETE')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/messages/' . $messageId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $request->exec();

        return null;
    }

    /**
     * Create webhook.
     *
     * See https://www.conoha.jp/docs/paas-mail-create-email-webhook.html
     *
     * @param string $emailId
     * @param string $webhookURI
     * @param string $webhookKeyword
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function postWebhook($emailId, $webhookURI, $webhookKeyword)
    {
        $data = array(
            'webhook_url' => $webhookURI,
            'webhook_keyword' => $webhookKeyword
        );

        $request = (new Request())
            ->setMethod('POST')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/webhook')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get webhook.
     *
     * See https://www.conoha.jp/docs/paas-mail-list-email-filter.html
     *
     * @param string $emailId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getWebhook($emailId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/webhook')
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change webhook.
     *
     * See https://www.conoha.jp/docs/paas-mail-update-email-filter.html
     *
     * @param string $emailId
     * @param string $webhookURI
     * @param string $webhookKeyword
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putWebhook($emailId, $webhookURI, $webhookKeyword)
    {
        $data = array(
            'webhook_url' => $webhookURI,
            'webhook_keyword' => $webhookKeyword
        );

        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/webhook')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Delete webhook.
     *
     * See https://www.conoha.jp/docs/paas-mail-delete-email-filter.html
     *
     * @param string $emailId
     * @return null
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function deleteWebhook($emailId)
    {
        $request = (new Request())
            ->setMethod('DELETE')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/webhook')
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $request->exec();
        return null;
    }

    /**
     * Get white list.
     *
     * $option can set offset, limit, sort_key, and sort_type.
     * 'offset' is list offset (int value).
     * 'limit' is list limit (int value).
     * 'sort_key is crate_date, service_name, and status.
     * 'sort_type' is asc or desc.
     *
     * See https://www.conoha.jp/docs/paas-mail-list-email-whitelist.html
     *
     * @param string $emailId
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getWhiteList($emailId, $options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/whitelist')
            ->setQuery($options)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change white list.
     *
     * See https://www.conoha.jp/docs/paas-mail-update-email-whitelist.html
     *
     * @param string $emailId
     * @param array $mailList
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putWhiteList($emailId, array $mailList)
    {
        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/whitelist')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($this->createTargetMailArray($mailList));

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get black list.
     *
     * $option can set offset, limit, sort_key, and sort_type.
     * 'offset' is list offset (int value).
     * 'limit' is list limit (int value).
     * 'sort_key is crate_date, service_name, and status.
     * 'sort_type' is asc or desc.
     *
     * See https://www.conoha.jp/docs/paas-mail-list-email-blacklist.html
     *
     * @param string $emailId
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getBlackList($emailId, $options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/blacklist')
            ->setQuery($options)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change black list.
     *
     * See https://www.conoha.jp/docs/paas-mail-update-email-blacklist.html
     *
     * @param string $emailId
     * @param array $mailList
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putBlackList($emailId, array $mailList)
    {
        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/emails/' . $emailId . '/blacklist')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($this->createTargetMailArray($mailList));

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Create forwarding setting.
     *
     * See https://www.conoha.jp/docs/paas-mail-create-email-forwarding.html
     *
     * @param string $emailId
     * @param string $address
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function postForwarding($emailId, $address)
    {
        $data = array(
            'email_id' => $emailId,
            'address' => $address
        );

        $request = (new Request())
            ->setMethod('POST')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/forwarding')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get forwarding setting.
     *
     * $option can set offset, limit, sort_key, and sort_type.
     * 'offset' is list offset (int value).
     * 'limit' is list limit (int value).
     * 'sort_key is crate_date, service_name, and status.
     * 'sort_type' is asc or desc.
     *
     * See https://www.conoha.jp/docs/paas-mail-list-email-forwarding.html
     *
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getForwardingList($options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/forwarding')
            ->setQuery($options)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get forwarding setting.
     *
     * See https://www.conoha.jp/docs/paas-mail-get-email-forwarding.html
     *
     * @param string $forwardingId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getForwarding($forwardingId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/forwarding/' . $forwardingId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Change forwarding setting.
     *
     * See https://www.conoha.jp/docs/paas-mail-update-email-forwarding.html
     *
     * @param string $forwardingId
     * @param string $address
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putForwarding($forwardingId, $address)
    {
        $data = array('address' => $address);

        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/forwarding/' . $forwardingId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($data);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Delete forwarding setting
     *
     * See https://www.conoha.jp/docs/paas-mail-delete-email-forwarding.html
     *
     * @param string $forwardingId
     * @return null
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function deleteForwarding($forwardingId)
    {
        $request = (new Request())
            ->setMethod('DELETE')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/forwarding/' . $forwardingId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $request->exec();

        return null;
    }

    /**
     * Create target mail array.
     *
     * @param array $targetArray
     * @return array
     */
    private function createTargetMailArray(array $targetArray)
    {
        $target = array();

        foreach ($targetArray as $value) {
            array_push($target, ['target' => $value]);
        }

        return array('targets' => $target);
    }
}
