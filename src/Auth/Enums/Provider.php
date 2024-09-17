<?php

namespace Zloberto\Nylas\Auth\Enums;

enum Provider: string
{
	case GOOGLE = 'google';
	case MICROSFT 'microsoft';
	case ICLOUD = 'icloud';
	case IMAP = 'imap';
	case YAHOO = 'yahoo';
	case EWS = 'ews';
	case ZOOM = 'zoom';
}