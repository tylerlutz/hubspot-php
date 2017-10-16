<?php

namespace SevenShores\Hubspot\Endpoints;

use SevenShores\Hubspot\Endpoint;

final class OAuth2 extends Endpoint
{
    /**
     * Initiate an Integration with OAuth 2.0
     *
     * In order to initiate OAuth access for your HubSpot App, you'll first
     * need to send a HubSpot user to an authorization page, where that user
     * will need to grant access to your app.  When your app sends a user to
     * that authorization page, you'll use the query parameters detailed below
     * to identify your app, and to also specify the scopes that your apps
     * requires.
     *
     * Initiating an OAuth connection requires that you create a HubSpot app.
     * The client ID that you'll need to include in the authorization URL can be
     * found in the settings for the app, which you can get to by clicking the
     * name of your app from your developer dashboard.
     *
     * Users must be signed into HubSpot to grant access, so any user that is
     * not logged into HubSpot will be directed to a login screen before being
     * directed back to the authorization page. The authorization screen will
     * show the details for your app, and the permissions being requested
     * (based on the scopes you include in the URL). Users will have the
     * option to select the Hub ID for the account they wish to grant access to.
     *
     * After the user grants access, they will be redirected to the redirect_uri
     * that you specified, with a code query parameter appended to the URL.
     * You'll use that code to get an access token from HubSpot.
     *
     * @see https://developers.hubspot.com/docs/methods/oauth2/initiate-oauth-integration
     *
     * @param string $clientId The Client ID of your app.
     * @param string $redirectURI The URL that you want the visitor redirected
     *     to after granting access to your app. For security reasons, this URL
     *     must use https.
     * @param array $scope A space separated set of scopes that your app will
     *     need access to. Scopes listed in this parameter will be treated as
     *     required for your app, and the user will see an error if they select
     *     an account that does not have access to the scope you've included.
     * @param array $optionalScope Optional scopes will be automatically dropped
     *     from the authorization request if the user selects a HubSpot account
     *     that does not have access to that tool (such as requesting the social
     *     scope on a CRM only portal).
     *
     * @return string
     */
    function getAuthUrl($clientId, $redirectURI, $scope = [], $optionalScope = [])
    {
        if (is_array($scope)) {
            $scope = implode('%20', $scope);
        }

        if (! empty($optionalScope)) {
            if (is_array($optionalScope)) {
                $optionalScope = implode('%20', $scope);
            }

            $optionalScope = ['optional_scope' => $optionalScope];
        }

        $params = array_merge($optionalScope, [
            'client_id' => $clientId,
            'scope' => $scope,
            'redirect_uri' => $redirectURI,
        ]);

        $queryString = build_query_string($params);

        return 'https://app.hubspot.com/oauth/authorize'.$queryString;
    }

    /**
     * Get OAuth 2.0 Access Token and Refresh Tokens by using a one-time code
     *
     * @param string $clientId The Client ID of your app.
     * @param string $clientSecret The Client Secret of your app.
     * @param string $redirectURI The redirect URI that was used when the user authorized your app. This must exactly match the redirect_uri used when initiating the OAuth 2.0 connection.
     * @param string $tokenCode The code parameter returned to your redirect URI when the user authorized your app. Or a refresh token.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getTokensByCode($clientId, $clientSecret, $redirectURI, $tokenCode)
    {
        $endpoint = 'https://api.hubapi.com/oauth/v1/token';

        $options['form_params'] = [
            'grant_type' => 'authorization_code',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri' => $redirectURI,
            'code' => $tokenCode,
        ];

        $options['headers']['content-type'] = 'application/x-www-form-urlencoded';

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Get OAuth 2.0 Access Token and Refresh Tokens by using a refresh token
     * Note: Contrary to HubSpot documentation, $redirectURI is NOT required.
     *
     * @param string $clientId The Client ID of your app.
     * @param string $clientSecret The Client Secret of your app.
     * @param string $refreshToken The refresh token.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getTokensByRefresh($clientId, $clientSecret, $refreshToken)
    {
        $endpoint = 'https://api.hubapi.com/oauth/v1/token';

        $options['form_params'] = [
            'grant_type' => 'refresh_token',
            'client_id' => $clientId,
            'client_secret' => $clientSecret,
            'refresh_token' => $refreshToken,
        ];

        $options['headers']['content-type'] = 'application/x-www-form-urlencoded';

        return $this->client->request('post', $endpoint, $options);
    }

    /**
     * Get Information for OAuth 2.0 Access Token
     *
     * @param  int $token The access token that you want to get the information for.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getAccessTokenInfo($token)
    {
        $endpoint = "https://api.hubapi.com/oauth/v1/access-tokens/{$token}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Get Information for OAuth 2.0 Refresh Token
     *
     * @param  int $token The refresh token that you want to get the information for.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function getRefreshTokenInfo($token)
    {
        $endpoint = "https://api.hubapi.com/oauth/v1/refresh-tokens/{$token}";

        return $this->client->request('get', $endpoint);
    }

    /**
     * Delete OAuth 2.0 Refresh Token
     *
     * @param  int $token The refresh token that you want to delete.
     * @return \SevenShores\Hubspot\Http\Response
     */
    function deleteRefreshToken($token)
    {
        $endpoint = "https://api.hubapi.com/oauth/v1/refresh-tokens/{$token}";

        return $this->client->request('delete', $endpoint);
    }

}
