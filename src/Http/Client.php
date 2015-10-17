<?php

namespace Fungku\HubSpot\Http;

use Fungku\HubSpot\Contracts\HttpClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\ClientInterface;

class Client implements HttpClient
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * Make it, baby.
     *
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(ClientInterface $client = null)
    {
        $this->client = $client ?: new GuzzleClient();
    }

    /**
     * @param string $url
     * @param array  $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function get($url, $options = [])
    {
        return new Response($this->client->get($url, $options));
    }

    /**
     * @param string $url
     * @param array  $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function post($url, $options = [])
    {
        return new Response($this->client->post($url, $options));
    }

    /**
     * @param string $url
     * @param array  $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function put($url, $options = [])
    {
        return new Response($this->client->put($url, $options));
    }

    /**
     * @param string $url
     * @param array  $options
     * @return \Fungku\HubSpot\Http\Response
     */
    public function delete($url, $options = [])
    {
        return new Response($this->client->delete($url, $options));
    }
}
