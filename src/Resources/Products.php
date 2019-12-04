<?php

namespace SevenShores\Hubspot\Products;

use SevenShores\Hubspot\Exceptions\HubspotException;

class Products extends Resource
{
    /**
     * @see https://developers.hubspot.com/docs/methods/products/get-all-products
     * 
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getAll(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/products/paged';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/products/get_product_by_id
     * 
     * @param int $id
     *
     * @return mixed
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/products/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/products/batch-get-products
     * 
     * @param array $productIds the products objectId you want to get
     *
     * @return mixed
     */
    public function getBatch(array $productIds)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/products/batch-read";

        $options['json'] = $productIds;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/products/create-product
     * 
     * @param array $product array of product properties
     *
     * @throws HubSpotException
     *
     * @return mixed
     */
    public function create(array $product)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/products';

        $options['json'] = $product;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/products/batch-create-products
     * 
     * @param array $products array of product properties
     *
     * @throws HubSpotException
     *
     * @return mixed
     */
    public function createBatch(array $products)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/products/batch-create';

        $options['json'] = $products;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/products/update-products
     * 
     * @param int   $id   the product id
     * @param array $product the product properties to update
     *
     * @return mixed
     */
    public function update($id, array $product)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/products/{$id}";

        $options['json'] = $product;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Update a group of existing product records by their objectId.
     *
     * @see https://developers.hubspot.com/docs/methods/products/batch-update-products
     *
     * @param array $products the products and properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateBatch(array $products)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/products/batch-update';

        $options['json'] = $products;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/products/delete-product
     * 
     * @param int $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/products/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/products/batch-delete-products
     * 
     * @param array $productIds the products objectId you want to delete
     *
     * @return mixed
     */
    public function deleteBatch(array $productIds)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/products/batch-delete";

        $options['json'] = $productIds;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/products/get-product-changes
     * 
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getChangeLog(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/change-log/products';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }
}