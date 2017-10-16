<?php

namespace SevenShores\Hubspot;

use SevenShores\Hubspot\Http\Client;

/**
 * Class Factory
 *
 * @method \SevenShores\Hubspot\Endpoints\BlogAuthors blogAuthors()
 * @method \SevenShores\Hubspot\Endpoints\Blogs blogs()
 * @method \SevenShores\Hubspot\Endpoints\BlogPosts blogPosts()
 * @method \SevenShores\Hubspot\Endpoints\BlogTopics blogTopics()
 * @method \SevenShores\Hubspot\Endpoints\Companies companies()
 * @method \SevenShores\Hubspot\Endpoints\CompanyProperties companyProperties()
 * @method \SevenShores\Hubspot\Endpoints\CalendarEvents calendarEvents()
 * @method \SevenShores\Hubspot\Endpoints\ContactLists contactLists()
 * @method \SevenShores\Hubspot\Endpoints\ContactProperties contactProperties()
 * @method \SevenShores\Hubspot\Endpoints\Contacts contacts()
 * @method \SevenShores\Hubspot\Endpoints\Email email()
 * @method \SevenShores\Hubspot\Endpoints\EmailEvents emailEvents()
 * @method \SevenShores\Hubspot\Endpoints\Engagements engagements()
 * @method \SevenShores\Hubspot\Endpoints\Files files()
 * @method \SevenShores\Hubspot\Endpoints\Forms forms()
 * @method \SevenShores\Hubspot\Endpoints\HubDB hubDB()
 * @method \SevenShores\Hubspot\Endpoints\Keywords keywords()
 * @method \SevenShores\Hubspot\Endpoints\Pages pages()
 * @method \SevenShores\Hubspot\Endpoints\SocialMedia socialMedia()
 * @method \SevenShores\Hubspot\Endpoints\Timeline timeline()
 * @method \SevenShores\Hubspot\Endpoints\Workflows workflows()
 * @method \SevenShores\Hubspot\Endpoints\Events events()
 * @method \SevenShores\Hubspot\Endpoints\DealPipelines dealPipelines()
 * @method \SevenShores\Hubspot\Endpoints\DealProperties dealProperties()
 * @method \SevenShores\Hubspot\Endpoints\Deals deals()
 * @method \SevenShores\Hubspot\Endpoints\Owners owners()
 * @method \SevenShores\Hubspot\Endpoints\SingleEmail singleEmail()
 */
class Factory
{
    /**
     * C O N S T R U C T O R ( ^_^)y
     *
     * @param  array $config An array of configurations. You need at least the 'key'.
     * @param  Client $client
     * @param array $clientOptions options to be send with each request
     * @param bool $wrapResponse wrap request response in own Response object
     */
    public function __construct($config = [], $client = null, $clientOptions = [], $wrapResponse = true)
    {
        $this->client = $client ?: new Client($config, null, $clientOptions, $wrapResponse);
    }

    /**
     * Create an instance of the service with an API key.
     *
     * @param  string $api_key Hubspot API key.
     * @param  Client $client An Http client.
     * @param array $clientOptions options to be send with each request
     * @param bool $wrapResponse wrap request response in own Response object
     * @return static
     */
    public static function create($api_key = null, $client = null, $clientOptions = [], $wrapResponse = true)
    {
        return new static(['key' => $api_key], $client, $clientOptions, $wrapResponse);
    }

    /**
     * Create an instance of the service with an Oauth token.
     *
     * @param  string $token Hubspot oauth access token.
     * @param  Client $client An Http client.
     * @param array $clientOptions options to be send with each request
     * @param bool $wrapResponse wrap request response in own Response object
     * @return static
     */
    public static function createWithToken($token, $client = null, $clientOptions = [], $wrapResponse = true)
    {
        return new static(['key' => $token, 'oauth' => true], $client, $clientOptions, $wrapResponse);
    }

    /**
     * Return an instance of a Resource based on the method called.
     *
     * @param  string  $name
     * @param  array   $arguments
     * @return \SevenShores\Hubspot\Endpoints\Endpoint
     */
    function __call($name, $arguments = null)
    {
        $resource = 'SevenShores\\SevenShores\Hubspot\\Endpoints\\' . ucfirst($name);

        return new $resource($this->client);
    }
}
