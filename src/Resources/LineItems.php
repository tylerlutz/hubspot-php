<?php

namespace SevenShores\Hubspot\Resources;

use SevenShores\Hubspot\Exceptions\HubspotException;

class LineItems extends Resource
{
    /**
     * @see https://developers.hubspot.com/docs/methods/line-items/get-all-line-items
     * 
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getAll(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/line_items/paged';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/line-items/get_line_item_by_id
     * 
     * @param int $id
     *
     * @return mixed
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/line_items/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/line-items/batch-get-line-items
     * 
     * @param array $lineItemIds the line items objectId you want to get
     *
     * @return mixed
     */
    public function getBatch(array $lineItemIds)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/line_items/batch-read";

        $options['json'] = $lineItemIds;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/line-items/create-line-item
     * 
     * @param array $lineItem array of line item properties
     *
     * @throws HubSpotException
     *
     * @return mixed
     */
    public function create(array $lineItem)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/line_items';

        $options['json'] = $lineItem;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/line-items/batch-create-line-items
     * 
     * @param array $lineItems array of line item properties
     *
     * @throws HubSpotException
     *
     * @return mixed
     */
    public function createBatch(array $lineItems)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/line_items/batch-create';

        $options['json'] = $lineItems;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/line-items/update-line-item
     * 
     * @param int   $id   the lineItem id
     * @param array $lineItem the line item properties to update
     *
     * @return mixed
     */
    public function update($id, array $lineItem)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/line_items/{$id}";

        $options['json'] = $lineItem;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Update a group of existing line item records by their objectId.
     *
     * @see https://developers.hubspot.com/docs/methods/line-items/batch-update-line-items
     *
     * @param array $lineItems the line items and properties
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function updateBatch(array $lineItems)
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/objects/line_items/batch-update';

        $options['json'] = $lineItems;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/line-items/delete-line-item
     * 
     * @param int $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/line_items/{$id}";

        return $this->client->request('delete', $endpoint);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/line-items/batch-delete-line-items
     * 
     * @param array $lineItemIds the line items objectId you want to delete
     *
     * @return mixed
     */
    public function deleteBatch(array $lineItemIds)
    {
        $endpoint = "https://api.hubapi.com/crm-objects/v1/objects/line_items/batch-delete";

        $options['json'] = $lineItemIds;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * @see https://developers.hubspot.com/docs/methods/line-items/get-line-item-changes
     * 
     * @throws \SevenShores\Hubspot\Exceptions\BadRequest
     *
     * @return \Psr\Http\Message\ResponseInterface|\SevenShores\Hubspot\Http\Response
     */
    public function getChangeLog(array $params = [])
    {
        $endpoint = 'https://api.hubapi.com/crm-objects/v1/change-log/line_items';

        $queryString = build_query_string($params);

        return $this->client->request('get', $endpoint, [], $queryString);
    }
}