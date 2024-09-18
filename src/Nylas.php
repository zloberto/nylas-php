<?php

namespace Zloberto\Nylas;

use Zloberto\Nylas\Auth\Grant;
use Zloberto\Nylas\Exceptions\UnsuccessfulTokenExchangeException;

/**
 * Class Nylas
 * A PHP SDK for interacting with the Nylas API.
 */
final class Nylas
{
	/**
	 * @var string The base URL for the Nylas API.
	 */
	private string $url;

	/**
	 * @var string The client ID for the Nylas application.
	 */
	private string $client_id;

	/**
	 * @var string The client secret for the Nylas application.
	 */
	private string $client_secret;

	/**
	 * @var string The OAuth callback URL.
	 */
	private string $callback;

	/**
	 * Nylas constructor.
	 *
	 * @param string $url The base URL for the Nylas API.
	 * @param string $client_id The client ID of the Nylas application.
	 * @param string $client_secret The client secret of the Nylas application.
	 * @param string $callback The OAuth callback URL.
	 */
	public function __construct(string $url, string $client_id, string $client_secret, string $callback)
	{
		$this->url = $url;
		$this->client_id = $client_id;
		$this->client_secret = $client_secret;
		$this->callback = $callback;
	}

	/**
	 * Generates the OAuth URL for user authentication.
	 *
	 * @param bool $online Whether to request an online (true) or offline (false) token. Default is true (online).
	 * @return string The OAuth URL for authentication.
	 */
	public function getOAuthUrl(bool $online = true): string
	{
		$type = $online ? 'online' : 'offline';

		return $this->url . '/v3/connect/auth?client_id=' . $this->client_id . '&redirect_uri=' . $this->callback . '&response_type=code&access_type=' . $type;
	}

	/**
	 * Exchanges the authorization code for an access token.
	 *
	 * @param string $code The authorization code obtained from the OAuth flow.
	 * @return object The response object containing the access token and other details.
	 * @throws UnsuccessfulTokenExchangeException if the token exchange fails.
	 */
	public function tokenExchange(string $token, bool $online = true): Grant
	{
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_URL, $this->url . '/v3/connect/token');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);

		if ($online)
		{
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
				'client_id' => $this->client_id,
				'client_secret' => $this->client_secret,
				'grant_type' => 'authorization_code',
				'code' => $token,
				'redirect_uri' => $this->callback,
				'code_verifier' => 'nylas',
			]));
		}
		else
		{
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
				'client_id' => $this->client_id,
				'client_secret' => $this->client_secret,
				'grant_type' => 'refresh_token',
				'refresh_token' => $token,
			]));
		}

		$response = curl_exec($curl);
		$code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

		curl_close($curl);

		$response = json_decode($response);

		if ($response === false)
		{
			throw new \RuntimeException('cURL Error: ' . curl_error($curl));
		}

		if ($code != 200) {
			throw new UnsuccessfulTokenExchangeException($response->error_description ?? 'Unknown error', $response->error_code);
		}

		return new Grant($response, $online);
	}
}
