<?php

namespace keika299\ConohaAPI\Image;


use keika299\ConohaAPI\Common\Network\Request;
use keika299\ConohaAPI\Common\Service\AbstractService;

/**
 * Class Service
 *
 * This class connect to ConoHa image service.
 *
 * @package keika299\ConohaAPI\Image
 */
class Service extends AbstractService
{

    /**
     * Get image list.
     *
     * See https://www.conoha.jp/docs/image-get_images_list.html
     *
     * @param array $options
     * @return mixed
     */
    public function getImageList($options = array())
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/images')
            ->setQuery($options)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get image information.
     *
     * See https://www.conoha.jp/docs/image-get_images_detail_specified.html
     *
     * @param string $imageId
     * @return mixed
     */
    public function getImageInfo($imageId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/images/' . $imageId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get images schema.
     *
     * See https://www.conoha.jp/docs/image-get_schemas_images_list.html
     *
     * Get Images schema
     * @return mixed
     */
    public function getImagesSchema()
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/schemas/images')
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get image schema
     *
     * See https://www.conoha.jp/docs/image-get_schemas_image_list.html
     *
     * @return mixed
     */
    public function getImageSchema()
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/schemas/image')
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get members schema.
     *
     * See https://www.conoha.jp/docs/image-get_schemas_members_list.html
     *
     * @return mixed
     */
    public function getMembersSchema()
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/schemas/members')
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get member schema.
     *
     * See https://www.conoha.jp/docs/image-get_schemas_member_list.html
     *
     * @return mixed
     */
    public function getMemberSchema()
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/schemas/member')
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get member list.
     *
     * See https://www.conoha.jp/docs/image-get_members_list.html
     *
     * @param string $imageId
     * @return mixed
     */
    public function getMemberList($imageId)
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/images/' . $imageId . '/members')
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Delete image.
     *
     * See https://www.conoha.jp/docs/image-remove_image.html
     *
     * @param string $imageId
     * @return null
     */
    public function deleteImage($imageId)
    {
        $request = (new Request())
            ->setMethod('DELETE')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/images/' . $imageId)
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $request->exec();
        return null;
    }

    /**
     * Change quota.
     *
     * Now, only can apply about tokyo region.
     *
     * See https://www.conoha.jp/docs/image-set_quota.html
     *
     * @param int $size
     * @return mixed
     */
    public function putQuota($size)
    {
        $optionsArray = array(
            'quota' => [
                'tyo1_image_size' => $size . 'GB'
            ]
        );

        $request = (new Request())
            ->setMethod('PUT')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/quota')
            ->setAccept('application/json')
            ->setToken($this->token->getToken())
            ->setJson($optionsArray);

        $response = $request->exec();
        return $response->getJson();
    }

    /**
     * Get quota
     *
     * See https://www.conoha.jp/docs/image-get_quota.html
     *
     * @return mixed
     */
    public function getQuota()
    {
        $request = (new Request())
            ->setMethod('GET')
            ->setBaseURI($this->baseURI)
            ->setURI('/v2/quota')
            ->setAccept('application/json')
            ->setToken($this->token->getToken());

        $response = $request->exec();
        return $response->getJson();
    }
}
