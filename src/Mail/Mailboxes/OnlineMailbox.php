<?php

namespace Zloberto\Nylas\Mail\Mailbox;

final class OnlineMailbox extends Mailbox
{
	public function __construct(Grant $grant)
	{
		parent::__construct($grant);
	}

	public function getAllMessages(
		int $limit = 50,
		?string $page_token = null,
		?string $select = null,
		?string $subject = null,
		?string $any_email = null,
		?string $to = null,
		?string $from = null,
		?string $cc = null,
		?string $bcc = null,
		?string $in = null,
		?bool $unread = null,
		?bool $starred = null,
		?string $thread_id = null,
		?int $received_before = null,
		?int $received_after = null,
		?Fields $fields = null,
		?string $search_query_native = null
	): array {
		$options = [];

		$options['limit'] = $limit;

		if ($page_token !== null) {
			$options['page_token'] = $page_token;
		}

		if ($select !== null) {
			$options['select'] = $select;
		}

		if ($subject !== null) {
			$options['subject'] = $subject;
		}

		if ($any_email !== null) {
			$options['any_email'] = $any_email;
		}

		if ($to !== null) {
			$options['to'] = $to;
		}

		if ($from !== null) {
			$options['from'] = $from;
		}

		if ($cc !== null) {
			$options['cc'] = $cc;
		}

		if ($bcc !== null) {
			$options['bcc'] = $bcc;
		}

		if ($in !== null) {
			$options['in'] = $in;
		}

		if ($unread !== null) {
			$options['unread'] = $unread;
		}

		if ($starred !== null) {
			$options['starred'] = $starred;
		}

		if ($thread_id !== null) {
			$options['thread_id'] = $thread_id;
		}

		if ($received_before !== null) {
			$options['received_before'] = $received_before;
		}

		if ($received_after !== null) {
			$options['received_after'] = $received_after;
		}

		if ($fields !== null) {
			$options['fields'] = $fields;
		}

		if ($search_query_native !== null) {
			$options['search_query_native'] = $search_query_native;
		}

		$query = http_build_query($options);
	}

}