<?php

namespace Zloberto\Nylas\Exceptions;

use Exception;

class UnsuccessfulTokenExchangeException extends Exception
{
	public function __construct(string $message, int $code)
	{
		parent::__construct($message, $code);
	}
}