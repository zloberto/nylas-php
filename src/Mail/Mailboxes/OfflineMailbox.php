<?php

namespace Zloberto\Nylas\Mail\Mailbox;

final class OfflineMailbox extends Mailbox
{
	public function __construct(Grant $grant)
	{
		parent::__construct($grant);
	}
}