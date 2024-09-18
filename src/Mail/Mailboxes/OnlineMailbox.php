<?php

namespace Zloberto\Nylas\Mail\Mailbox;

final class OnlineMailbox extends Mailbox
{
	public function __construct(Grant $grant)
	{
		parent::__construct($grant);
	}
}