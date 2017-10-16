<?php

namespace SevenShores\Hubspot\Endpoints;

use SevenShores\Hubspot\Endpoint;

final class DealPipelines extends Endpoint
{
    /**
     * Get all Deal Pipelines.
     *
     * This endpoint will return all deal pipelines for a given portal.
     *
     * @see https://developers.hubspot.com/docs/methods/deal-pipelines/get-all-deal-pipelines
     *
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function all()
    {
        $endpoint = 'https://api.hubapi.com/deals/v1/pipelines';

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get a Deal Pipeline.
     *
     * This endpoint will return a specific deal pipeline. Every portal initially
     * contains a default pipeline with the pipelineId “default”.
     *
     * @see https://developers.hubspot.com/docs/methods/deal-pipelines/get-deal-pipeline
     *
     * @param string $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function getById($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Create a Deal Pipeline.
     *
     * This endpoint will create a new deal pipeline. The API will automatically
     * generate a unique pipelineId for the pipeline.
     *
     * The request may specify dealstages for the pipeline. If dealstages are
     * omitted, the API will automatically generate a default set of dealstages
     * for the pipeline. Every saved pipeline has at least one dealstage.
     *
     * @see https://developers.hubspot.com/docs/methods/deal-pipelines/create-deal-pipeline
     *
     * @param array $pipeline
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function create($pipeline)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines";

        $options['json'] = $pipeline;

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Update a Deal Pipeline.
     *
     * This endpoint will overwrite an existing deal pipeline.
     *
     * The request must specify dealstages for the pipeline. The dealstages
     * included in the request will overwrite the existing dealstages for the
     * pipeline, including deleting previously existing dealstages that are not
     * included in the updated pipeline request.
     *
     * If you're removing a dealstage from a pipeline, we strongly recommend
     * moving existing deals into a different dealstage first.
     *
     * @see https://developers.hubspot.com/docs/methods/deal-pipelines/update-deal-pipeline
     *
     * @param string $id
     * @param array $pipeline
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function update($id, $pipeline)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        $options['json'] = $pipeline;

        return $this->client->request('put', $endpoint, $options);
    }

    /**
     * Delete a Deal Pipeline.
     *
     * For a portal, delete an existing deal pipeline.
     *
     * Before deleting a deal pipeline, we strongly recommend moving any deals
     * in the pipeline to a different pipeline.
     *
     * @see https://developers.hubspot.com/docs/methods/deals/delete_deal_pipeline
     *
     * @param string $id
     * @return \SevenShores\Hubspot\Http\Response
     */
    public function delete($id)
    {
        $endpoint = "https://api.hubapi.com/deals/v1/pipelines/{$id}";

        return $this->client->request('delete', $endpoint);
    }
}
