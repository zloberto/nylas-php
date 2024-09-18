<?php

namespace Zloberto\Nylas\Auth;

use Zloberto\Nylas\Auth\Enums\GrantType;
use Zloberto\Nylas\Auth\Enums\Provider;

/**
 * Class Grant
 *
 * Represents a grant object containing authentication tokens and other related information.
 */
class Grant
{
	/**
	 * The access token used for authentication.
	 *
	 * @var string
	 */
	private string $access_token;

	/**
	 * The duration in seconds before the access token expires.
	 *
	 * @var int
	 */
	private int $expires_in;

	/**
	 * The ID token associated with the identity.
	 *
	 * @var string
	 */
	private string $id_token;

	/**
	 * The email address associated with the identity.
	 *
	 * @var string
	 */
	private string $email;

	/**
	 * The refresh token used to obtain a new access token.
	 * Returned only if the authorization code was requested using offline access type.
	 *
	 * @var string|null
	 */
	private ?string $refresh_token;

	/**
	 * The scopes associated with the access token.
	 *
	 * @var array
	 */
	private array $scopes;

	/**
	 * The type of the token (currently always Bearer).
	 *
	 * @var string
	 */
	private string $token_type;

	/**
	 * The grant ID used for authorization.
	 *
	 * @var string
	 */
	private string $grant_id;

	/**
	 * The provider associated with the grant.
	 *
	 * @var Provider|null
	 */
	private ?Provider $provider;

	/**
	 * The grant type for the authorization flow.
	 *
	 * @var GrantType
	 */
	private GrantType $grant_type;

	/**
	 * Constructor to initialize the Grant object.
	 *
	 * @param object $grant The grant data object.
	 * @throws \InvalidArgumentException If invalid data is provided.
	 */
	public function __construct(object $grant, bool $online)
	{
		$this->access_token = $grant->access_token;
		$this->expires_in = $grant->expires_in;
		$this->id_token = $grant->id_token;
		$this->email = $grant->email;
		$this->refresh_token = $grant->refresh_token ?? null;
		$this->scopes = explode(' ', $grant->scopes);
		$this->token_type = $grant->token_type;
		$this->grant_id = $grant->grant_id;
		$this->provider = Provider::tryFrom($grant->provider ?? 'null');
		$this->grant_type = $online ? GrantType::ONLINE : GrantType::OFFLINE;
	}

	/**
	 * Check if the access token is expired.
	 *
	 * @return bool True if the access token has expired, false otherwise.
	 */
	public function isTokenExpired(): bool
	{
		return $this->expires_in === 0;
	}

	/**
	 * Get the access token used for authentication.
	 *
	 * @return string The access token.
	 */
	public function getAccessToken(): string
	{
		return $this->access_token;
	}

	/**
	 * Get the duration in seconds before the access token expires.
	 *
	 * @return int The expiration duration in seconds.
	 */
	public function getExpiresIn(): int
	{
		return $this->expires_in;
	}

	/**
	 * Get the ID token associated with the identity.
	 *
	 * @return string The ID token.
	 */
	public function getIdToken(): string
	{
		return $this->id_token;
	}

	/**
	 * Get the email address associated with the identity.
	 *
	 * @return string The email address.
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * Get the refresh token used to obtain a new access token.
	 *
	 * @return string|null The refresh token, or null if unavailable.
	 */
	public function getRefreshToken(): ?string
	{
		return $this->refresh_token;
	}

	/**
	 * Get the scopes associated with the access token.
	 *
	 * @return array The list of scopes.
	 */
	public function getScopes(): array
	{
		return $this->scopes;
	}

	/**
	 * Get the type of the token (currently always Bearer).
	 *
	 * @return string The token type.
	 */
	public function getTokenType(): string
	{
		return $this->token_type;
	}

	/**
	 * Get the grant ID used for authorization.
	 *
	 * @return string The grant ID.
	 */
	public function getGrantId(): string
	{
		return $this->grant_id;
	}

	/**
	 * Get the provider name associated with the authorized grant.
	 *
	 * @return Provider|null The provider, or null if unavailable.
	 */
	public function getProvider(): ?Provider
	{
		return $this->provider;
	}

	/**
	 * Get the grant type.
	 *
	 * @return GrantType Grant type.
	 */
	public function getGrantType(): GrantType
	{
		return $this->grant_type;
	}

	/**
	 * Serialize the grant object to an array.
	 *
	 * @return array The serialized array representation of the grant object.
	 */
	public function toArray(): array
	{
		return [
			'access_token' => $this->access_token,
			'expires_in' => $this->expires_in,
			'id_token' => $this->id_token,
			'email' => $this->email,
			'refresh_token' => $this->refresh_token,
			'scopes' => $this->scopes,
			'token_type' => $this->token_type,
			'grant_id' => $this->grant_id,
			'provider' => $this->provider,
		];
	}

	/**
	 * Serialize the grant object to JSON.
	 *
	 * @return string The JSON representation of the grant object.
	 */
	public function toJson(): string
	{
		return json_encode($this->toArray());
	}
}
