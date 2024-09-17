<?php

namespace Zloberto\Nylas\Auth\Enums;

enum GrantType: string
{
	case ONLINE = 'online';
	case OFFLINE = 'offline';
}