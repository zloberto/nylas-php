<?php

namespace Zloberto\Nylas\Mail\Factories;

use Zloberto\Nylas\Auth\Grant;
use Zloberto\Nylas\Auth\Enums\GrantType;
use Zloberto\Nylas\Mail\Mailbox\Mailbox;
use Zloberto\Nylas\Mail\Mailbox\OfflineMailbox;
use Zloberto\Nylas\Mail\Mailbox\OnlineMailbox;

final class MailboxFactory
{
	public static function create(Grant $grant): Mailbox
	{
		if ($grant->getGrantType() === GrantType::ONLINE)
		{
			return new OnlineMailbox($grant);
		}

		if ($grant->getGrantType() === GrantType::OFFLINE)
		{
			return new OfflineMailbox($grant);
		}

		throw new InvalidGrantTypeException;
	}
}
