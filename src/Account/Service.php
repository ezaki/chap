<?php

namespace keika299\ConohaAPI\Account;


use keika299\ConohaAPI\Common\Network\Request;
use keika299\ConohaAPI\Common\Service\AbstractService;

/**
 * Class Service
 *
 * This class connect to ConoHa account service.
 *
 * @package keika299\ConohaAPI\Account
 */
class Service extends AbstractService
{
    /**
     * Get version information.
     *
     * See https://www.conoha.jp/docs/account-get_version_list.html
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
     * See https://www.conoha.jp/docs/account-get_version_detail.html
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
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get order item list.
     *
     * See https://www.conoha.jp/docs/account-order-item-list.html
     *
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getOrderItems()
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/order-items')
            ->setAccept('application/json')
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get order item.
     *
     * $itemId is item's UUID.
     *
     * See https://www.conoha.jp/docs/account-order-item-detail-specified.html
     *
     * @param string $itemId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getOrderItem($itemId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/order-items/'.$itemId)
            ->setAccept('application/json')
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get product items
     *
     * $serviceName is service's name.
     * Valid service name is ...
     * VPS, VPSAddDisk, VPSBackup, AddIP, LoadBalancer, ImageSave, Mail, MailBackup, StaticIP,
     * MailAddDisk, DB, DBBackup, DBAddDisk, ObjectStorage and DNS.
     *
     * See https://www.conoha.jp/docs/account-products.html
     *
     * @param string|null $serviceName
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getProductItems($serviceName = null)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/product-items'. ($serviceName !== null ? '?service_name='.$serviceName : ''))
            ->setAccept('application/json')
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get payment history.
     *
     * See https://www.conoha.jp/docs/account-payment-histories.html
     *
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getPaymentHistory()
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/payment-history')
            ->setAccept('application/json')
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get payment summary.
     *
     * See https://www.conoha.jp/docs/account-payment-summary.html
     *
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getPaymentSummary()
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/payment-summary')
            ->setAccept('application/json')
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get billing invoice list.
     *
     * $options is list's offset and limit.
     * For example,
     * $options = array(
     *  'offset' => 3,
     *  'limit' => 5
     * );
     * list count is 5, and to suppress 3 newer.
     *
     * See https://www.conoha.jp/docs/account-billing-invoices-list.html
     *
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getBillingInvoices($options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/billing-invoices'.$this->getOffsetAndLimitQuery($options))
            ->setAccept('application/json')
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get billing invoice.
     *
     * $invoiceId is invoice's id.
     *
     * See https://www.conoha.jp/docs/account-billing-invoices-detail-specified.html
     *
     * @param string $invoiceId
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getBillingInvoice($invoiceId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/billing-invoices/'.$invoiceId)
            ->setAccept('application/json')
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get notification list.
     *
     * $options is list's offset and limit.
     * For example,
     * $options = array(
     *  'offset' => 3,
     *  'limit' => 5
     * );
     * list count is 5, and to suppress 3 newer.
     *
     * See https://www.conoha.jp/docs/account-informations-list.html
     *
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getNotifications($options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/notifications'.$this->getOffsetAndLimitQuery($options))
            ->setAccept('application/json')
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get notification.
     *
     * $notificationId is notification's code.
     *
     * See https://www.conoha.jp/docs/account-informations-detail-specified.html
     *
     * @param string $notificationCode
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getNotification($notificationCode)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/notifications/'.$notificationCode)
            ->setAccept('application/json')
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Put notification status.
     *
     * Change notification status.
     * $notificationCode is notification's code.
     * $status is notification status.
     * $status allow Unread, ReadTitleOnly, and Read.
     *
     * @param string $notificationCode
     * @param string $status
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function putNotificationStatus($notificationCode, $status)
    {
        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/notifications/'.$notificationCode)
            ->setAccept('application/json')
            ->setToken($this->client->getToken())
            ->setJson(array(
                'notification' => [
                    'read_status' => $status
                ]
            ));

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get object storage request volume.
     *
     * $options is data range and data mode.
     * 'start_date_raw' is start date UNIX time.
     * 'end_date_raw' is end date UNIX time.
     * 'mode' is data mode. It can be select average, max, and min.
     *
     * See https://www.conoha.jp/docs/account-get_objectstorage_request_rrd.html
     *
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getObjectStorageRequest($options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/object-storage/rrd/request'.$this->getDataRangeAndModeQuery($options))
            ->setAccept('application/json')
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get object storage size.
     *
     * $options is data range and data mode.
     * 'start_date_raw' is start date UNIX time.
     * 'end_date_raw' is end date UNIX time.
     * 'mode' is data mode. It can be select average, max, and min.
     *
     * See https://www.conoha.jp/docs/account-get_objectstorage_size_rrd.html
     *
     * @param array $options
     * @return mixed
     * @throws \keika299\ConohaAPI\Common\Exceptions\IConohaAPIException
     */
    public function getObjectStorageSize($options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v1/'.$this->client->getTenantId().'/object-storage/rrd/size'.$this->getDataRangeAndModeQuery($options))
            ->setAccept('application/json')
            ->setToken($this->client->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get offset and limit query from options params.
     *
     * @param array $options
     * @return string
     */
    private function getOffsetAndLimitQuery($options)
    {
        $optionQuery = '';

        if (isset($options['offset'])) {
            $optionQuery = '?offset='.$options['offset'];
        }

        if (isset($options['limit'])) {
            if ($optionQuery === '') {
                $optionQuery = '?limit='.$options['limit'];
            }
            else {
                $optionQuery = $optionQuery.'&limit='.$options['limit'];
            }
        }

        return $optionQuery;
    }

    /**
     * Get data range and mode query from options params.
     *
     * @param array $options
     * @return string
     */
    private function getDataRangeAndModeQuery($options)
    {
        $optionQuery = '';

        if (isset($options['start_date_raw'])) {
            $optionQuery = '?offset='.$options['start_date_raw'];
        }
        if (isset($options['end_date_raw'])) {
            if ($optionQuery === '') {
                $optionQuery = '?end_date_raw='.$options['end_date_raw'];
            }
            else {
                $optionQuery = $optionQuery.'&end_date_raw='.$options['end_date_raw'];
            }
        }
        if (isset($options['mode'])) {
            if ($optionQuery === '') {
                $optionQuery = '?mode='.$options['mode'];
            }
            else {
                $optionQuery = $optionQuery.'&mode='.$options['mode'];
            }
        }

        return $optionQuery;
    }
}
